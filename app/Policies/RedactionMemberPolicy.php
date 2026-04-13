<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\RedactionMember;
use Illuminate\Auth\Access\HandlesAuthorization;

class RedactionMemberPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:RedactionMember');
    }

    public function view(AuthUser $authUser, RedactionMember $redactionMember): bool
    {
        return $authUser->can('View:RedactionMember');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:RedactionMember');
    }

    public function update(AuthUser $authUser, RedactionMember $redactionMember): bool
    {
        return $authUser->can('Update:RedactionMember');
    }

    public function delete(AuthUser $authUser, RedactionMember $redactionMember): bool
    {
        return $authUser->can('Delete:RedactionMember');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:RedactionMember');
    }

    public function restore(AuthUser $authUser, RedactionMember $redactionMember): bool
    {
        return $authUser->can('Restore:RedactionMember');
    }

    public function forceDelete(AuthUser $authUser, RedactionMember $redactionMember): bool
    {
        return $authUser->can('ForceDelete:RedactionMember');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:RedactionMember');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:RedactionMember');
    }

    public function replicate(AuthUser $authUser, RedactionMember $redactionMember): bool
    {
        return $authUser->can('Replicate:RedactionMember');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:RedactionMember');
    }

}