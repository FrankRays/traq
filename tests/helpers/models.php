<?php

use Traq\Models\User;
use Traq\Models\Group;
use Traq\Models\Project;
use Traq\Models\ProjectRole;
use Traq\Models\Ticket;
use Traq\Models\Milestone;
use Traq\Models\WikiPage;
use Traq\Models\WikiRevision;
use Traq\Models\Priority;
use Traq\Models\Severity;
use Traq\Models\Status;

function createUser($password = null, $group = null)
{
    if (!$group) {
        $groupId = 3;
    } else {
        $groupId = $group['id'];
    }

    $user = new User([
        'name'     => 'user-' . mkRandomHash(5) . '-name',
        'username' => 'user-' . mkRandomHash(5) . '-username',
        'email'    => 'user-' . mkRandomHash(5) . '-email@example.com',
        'password' => $password ?: microtime(),
        'group_id' => $groupId
    ]);
    $user->save();

    return $user;
}

function createAdmin($password = null, $group = null)
{
    return createUser($password, Group::find(1));
}

function createGroup()
{
    $group = new Group([
        'name' => 'group-' . mkRandomHash(5) . '-name'
    ]);
    $group->save();

    return $group;
}

function createProject()
{
    $project = new Project([
        'name' => 'project-' . mkRandomHash(5) . '-name',
        'slug' => 'project-' . mkRandomHash(5) . '-slug'
    ]);
    $project->save();

    return $project;
}

function createProjectRole()
{
    $role = new ProjectRole([
        'name' => 'project-role-' . mkRandomHash(5) . '-name'
    ]);
    $role->save();

    return $role;
}

function createMilestone($project = null)
{
    if (!$project) {
        $project = createProject();
    }

    $milestone = new Milestone([
        'name' => 'milestone-' . mkRandomHash(5) . '-name',
        'slug' => 'milestone-' . mkRandomHash(5) . '-slug',
        'project_id' => $project['id']
    ]);
    $milestone->save();

    return $milestone;
}

function createTicket($project = null, $milestone = null, $user = null)
{
    if (!$project) {
        $project = createProject();
    }

    if (!$milestone) {
        $milestone = createMilestone($project);
    }

    if (!$user) {
        $user = createUser();
    }

    $ticket = new Ticket([
        'ticket_id'    => $project['next_ticket_id'],
        'summary'      => 'ticket-' . mkRandomHash(5) . '-summary',
        'body'         => 'ticket-' . mkRandomHash(5) . '-body',
        'project_id'   => $project['id'],
        'user_id'      => $user['id'],
        'type_id'      => 1,
        'milestone_id' => $milestone['id']
    ]);
    $ticket->save();

    $project['next_ticket_id'] = $project['next_ticket_id'] + 1;
    $project->save();

    return $ticket;
}

function createWikiPage($project = null, $user = null)
{
    if (!$project) {
        $project = createProject();
    }

    if (!$user) {
        $user = createUser();
    }

    $prefix = 'wikipage-' . mkRandomHash(5);

    $page = new WikiPage([
        'title'      => $prefix . '-title',
        'slug'       => $prefix . '-slug',
        'project_id' => $project['id']
    ]);

    $revision = new WikiRevision([
        'content' => $prefix . '-content',
        'user_id' => $user['id']
    ]);

    $page->save();

    $revision['wiki_page_id'] = $page['id'];
    $revision->save();

    $page['revision_id'] = $revision['id'];
    $page->save();

    return $page;
}

function createPriority()
{
    $priority = new Priority([
        'name' => 'priority-' . mkRandomHash(5) . '-name'
    ]);
    $priority->save();

    return $priority;
}

function createSeverity()
{
    $severity = new Severity([
        'name' => 'severity-' . mkRandomHash(5) . '-name'
    ]);
    $severity->save();

    return $severity;
}

function createStatus()
{
    $status = new Status([
        'name' => 'status-' . mkRandomHash(5) . '-name'
    ]);
    $status->save();

    return $status;
}
