<?php

namespace Juzaweb\Backend\Http\Controllers\Backend;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Juzaweb\Backend\Http\Datatables\EmailTemplateDataTable;
use Juzaweb\Backend\Models\EmailTemplate;
use Juzaweb\CMS\Contracts\HookActionContract;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Juzaweb\CMS\Models\Model;
use Juzaweb\CMS\Traits\ResourceController;

class EmailTemplateController extends BackendController
{
    protected string $editKey = 'code';

    use ResourceController {
        getDataForForm as DataForForm;
    }

    protected string $viewPrefix = 'cms::backend.email_template';

    protected function getDetailModel(Model $model, ...$params): Model
    {
        $code = $this->getPathId($params);
        $model = $model
            ->where($this->editKey ?? 'id', $this->getPathId($params))
            ->firstOrNew();
        if ($model->id === null) {
            $template = app(HookActionContract::class)->getEmailTemplates($code);
            $template->put('body', File::get(view($template->get('body'))->getPath()));
            $model->fill($template->toArray());
        }
        return $model;
    }

    protected function getDataTable(...$params): EmailTemplateDataTable
    {
        return EmailTemplateDataTable::make();
    }

    protected function validator(array $attributes, ...$params): \Illuminate\Contracts\Validation\Validator
    {
        $code = $attributes['code'] ?? null;

        return Validator::make(
            $attributes,
            [
                'subject' => ['required'],
                'body' => ['required'],
                'code' => [
                    'required',
                    'max:50',
                    Rule::modelUnique(
                        EmailTemplate::class,
                        'code',
                        function (Builder $q) use ($code) {
                            $q->where("{$q->getModel()->getTable()}.code", '!=', $code);
                        }
                    ),
                ],
            ]
        );
    }

    protected function getModel(...$params): string
    {
        return EmailTemplate::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('cms::app.email_templates');
    }

    protected function getDataForForm($model, ...$params): array
    {
        $data = $this->DataForForm($model);
        $data['emailHooks'] = HookAction::getEmailHooks();
        return $data;
    }
}
