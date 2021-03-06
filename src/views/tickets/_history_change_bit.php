<?php
if (!function_exists('_mklocale')) {
    function _mklocale($change, $locale_property = 'x')
    {
        if (!empty($change['to']) and !empty($change['from'])) {
            $string = "{$locale_property}_from_x_to_x";
        } elseif (!empty($change['to']) and empty($change['from'])) {
            $string = "{$locale_property}_from_null_to_x";
        } elseif (empty($change['to']) and !empty($change['from'])) {
            $string = "{$locale_property}_from_x_to_null";
        }

        if (is_array($change['from'])) {
            $change['from'] = implode(', ', $change['from']);
        }

        if (is_array($change['to'])) {
            $change['to'] = implode(', ', $change['to']);
        }

        return t(
            "ticket_history.{$string}",
            '<span class="ticket-history-property">' . t($change['property']) . '</span>',
            '<span class="ticket-history-from">' . htmlspecialchars($change['from']) . '</span>',
            '<span class="ticket-history-to">' . htmlspecialchars($change['to']) . '</span>'
        );
    }
}

// Was an action performed?
if (isset($change['action'])) {
    echo t("ticket_history.{$change['action']}", $change['from'], $change['to']);
}
// Is this the assigned_to property?
elseif ($change['property'] == 'assigned_to') {
    foreach (array('to', 'from') as $key) {
        // Is the to/from values a user id?
        if (is_numeric($change[$key]) and $change[$key] !== null and $change[$key] != 0) {
            // Set it to the users name
            $change[$key] = Traq\Models\User::find($change[$key])->name;
        }
    }
    echo _mklocale($change, 'assignee');
}
// Tasks
elseif ($change['property'] == 'tasks') {
    $change['to'] = implode(', ', $change['to']);
    $change['from'] = implode(', ', $change['from']);
    echo _mklocale($change);
}
// For everything else
else {
    echo _mklocale($change);
}
