<?php

namespace Juzaweb\Backend\Policies;

use Juzaweb\CMS\Abstracts\ResourcePolicy;

class UserPolicy extends ResourcePolicy
{
    protected $resourceType = 'users';
}
