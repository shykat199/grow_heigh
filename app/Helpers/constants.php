<?php

const PENDING_STATUS = 0;
const ACTIVE_STATUS = 1;
const DELETE_STATUS = 2;

const SUPER_ADMIN = 1;
const ADMIN_ROLE = 2;
const USER_ROLE = 3;
const DEVELOPER = 4;

const PAGE_URL = [
  'home' => '/',
  'about' => 'about',
  'contact' => 'contact',
  'services' => 'services',
  'portfolio' => 'portfolio',
  'blog' => 'blog',
  'university' => 'university',
  'university details' => 'university-details',
  'study area' => 'study-area',
  'study level' => 'study-level',
  'test prep' => 'test-prep',
];


const ALL_USER_ROLE = [
    'Super Admin' => SUPER_ADMIN,
    'Admin' => ADMIN_ROLE,
    'User' => USER_ROLE,
    'Developer' => DEVELOPER,
];

const COUNTRY_ARRAY = ['Sri Lanka','India','Bangladesh','Australia','Global'];

const STUDY_LEVEL_ARRAY = [
    'undergraduate'=>'Undergraduate(UG)',
    'postgraduate'=>'Postgraduate(PG)',
    'path_way'=>'Path Way',
    'phd'=>'Doctorate(PhD)',
];

const STUDY_MODE_ARRAY = [
    'online'=>'online',
    'on_campus'=>'on_campus',
    'hybrid'=>'Hybrid',
];
