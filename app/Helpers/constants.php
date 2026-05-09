<?php

const PENDING_STATUS = 0;
const ACTIVE_STATUS = 1;
const DELETE_STATUS = 2;

const SUPER_ADMIN = 1;
const ADMIN_ROLE = 2;
const USER_ROLE = 3;
const DEVELOPER = 4;

const PAGE_URL = [
  'home' => 'home',
  'about' => 'about',
  'contact' => 'contact',
  'service' => 'service',
  'project' => 'project',
  'blog' => 'blog',
  'team' => 'team',
  'testimonial' => 'testimonial',
];


const ALL_USER_ROLE = [
    'Super Admin' => SUPER_ADMIN,
    'Admin' => ADMIN_ROLE,
    'User' => USER_ROLE,
    'Developer' => DEVELOPER,
];

const CATEGORY_TYPES = [
    'blog' => 'Blog',
    'service' => 'Service',
    'project' => 'Project',
    'other' => 'Other',
];

