<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AdPackage;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdPackagePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AdPackage');
    }

    public function view(AuthUser $authUser, AdPackage $adPackage): bool
    {
        return $authUser->can('View:AdPackage');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AdPackage');
    }

    public function update(AuthUser $authUser, AdPackage $adPackage): bool
    {
        return $authUser->can('Update:AdPackage');
    }

    public function delete(AuthUser $authUser, AdPackage $adPackage): bool
    {
        return $authUser->can('Delete:AdPackage');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:AdPackage');
    }

    public function restore(AuthUser $authUser, AdPackage $adPackage): bool
    {
        return $authUser->can('Restore:AdPackage');
    }

    public function forceDelete(AuthUser $authUser, AdPackage $adPackage): bool
    {
        return $authUser->can('ForceDelete:AdPackage');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:AdPackage');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:AdPackage');
    }

    public function replicate(AuthUser $authUser, AdPackage $adPackage): bool
    {
        return $authUser->can('Replicate:AdPackage');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:AdPackage');
    }

}