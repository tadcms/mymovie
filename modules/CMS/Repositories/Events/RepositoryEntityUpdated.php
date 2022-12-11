<?php

namespace Juzaweb\CMS\Repositories\Events;

use Juzaweb\CMS\Support\Repository\Events\RepositoryEventBase;

/**
 * Class RepositoryEntityUpdated
 *
 * @package Prettus\Repository\Events
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class RepositoryEntityUpdated extends RepositoryEventBase
{
    /**
     * @var string
     */
    protected $action = "updated";
}