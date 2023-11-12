<?php

namespace MvcBlog\App\Enum;

enum Role: string
{
    case GUEST = 'guest';
    case ADMIN = 'admin';
}
