<?php

// code
const CODE_SUCCESS = 0;
const CODE_ERROR = 1;

const ROLE_ADMIN = 'admin';
const ROLE_MEMBER = 'member';
const ROLE_SELLER = 'seller';

const MID_ROLE_ADMIN = 'role:admin';
const MID_ROLE_MEMBER = 'role:member';

const FILTER_TYPE = [
    'NUMBER' => "number",
    'TEXT' => "text",
    "SELECT" => "select",
    "RESOURCE" => "resource",
    "BOOLEAN" => "boolean",
    "DATE" => "date",
    "CUSTOM" => "custom"
];

const OPERATOR = [
    'IN' => "in",
    'LIKE' => "like",
    'EQUAL' => "eq",
    'NOT_EQUAL' => "ne",
    'GREATER_THAN' => "gt",
    'LESS_THAN' => "lt",
    'GREATER_THAN_OR_EQUAL' => "gte",
    'LESS_THAN_OR_EQUAL' => "lte",
    'NONE' => "none"
];

const SELECT_ALL = -1;

const DATE_TIME_FORMAT = 'Y-m-d H:i:s';
const DISPLAY_DATE_FORMAT = 'Y/m/d';
