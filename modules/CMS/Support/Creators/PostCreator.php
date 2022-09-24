<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     Juzaweb Team <admin@juzaweb.com>
 * @link       https://juzaweb.com
 * @license    MIT
 */

namespace Juzaweb\CMS\Support\Creators;

use Illuminate\Support\Arr;
use Juzaweb\Backend\Models\Post;
use Juzaweb\Backend\Repositories\PostRepository;
use Juzaweb\CMS\Contracts\PostCreatorContract;

class PostCreator implements PostCreatorContract
{
    protected PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function create(array $data, array $options = []): Post
    {
        $model = $this->postRepository->create($data);

        $model->syncTaxonomies($data);

        $meta = Arr::get($data, 'meta', []);

        $model->syncMetas($meta);

        return $model;
    }
}
