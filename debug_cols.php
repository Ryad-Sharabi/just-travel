<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

$columns = Schema::getColumnListing('flutter_users');
echo implode(', ', $columns);
