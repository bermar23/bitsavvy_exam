<?php

namespace Models;

interface MyModel
{
    public static function getData($sort_field, $sort_by, $limit);
}