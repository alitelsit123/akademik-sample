<?php

function getTableColumn($name, $filter = []) {
    return collect(Schema::getColumnListing($name))->filter(function($item,$index) use ($filter) {
        return !in_array($item, $filter);
    });
}
