<?php

namespace Obelaw\UI\Permissions;

use Attribute;

#[Attribute]
final class Access
{
    public function __construct(
        public string $permission
    ) {
    }
}
