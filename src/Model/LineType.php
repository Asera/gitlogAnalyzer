<?php

namespace GitLogAnalyzer\Model;

class LineType
{
    const LINE_TYPE_CHANGESET = 'changeset';
    const LINE_TYPE_TAG = 'tag';
    const LINE_TYPE_USER = 'user';
    const LINE_TYPE_DATE = 'date';
    const LINE_TYPE_SUMMARY = 'summary';
    const LINE_TYPE_FILE_CHANGE = 'file_change';
    const LINE_TYPE_TOTAL_STATISTICS = 'total_statistics';

    const LINE_TYPE_UNSUPPORTED = 'unsupported';
}