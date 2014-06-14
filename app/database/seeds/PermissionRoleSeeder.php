<?php

class PermissionRoleSeeder extends Seeder
{
    private static $roleList = array(
        'admin',
        'admin_read_only',
        'user',
    );

    private static $adminPermList = array(
        'comment.read',
        'comment.write',
        'image.read',
        'image.write',
        'user.read',
        'user.write',
    );

    private $roleIds;
    private $readOnlyPermissionIds = array();
    private $adminPermissionIds = array();

    public function run()
    {
        DB::table('permissions')->truncate();
        DB::table('permission_role')->truncate();
        DB::table('roles')->truncate();

        $this->createRoles();
        $this->createAdminPermissions();
        $this->assignAdminPermissions();
    }

    private function createAdminPermissions()
    {
        foreach (self::$adminPermList as $perm) {
            list($entity, $mode) = explode('.', $perm);
            $permName = ucwords($entity . ' ' . $mode);
            $permission = Permission::create(array(
                'name' => $perm,
                'display_name' => $permName
            ));

            $this->adminPermissionIds[] = $permission->id;

            if ($mode == 'read') {
                $this->readOnlyPermissionIds[] = $permission->id;
            }
        }
    }

    private function createRoles()
    {
        foreach (self::$roleList as $roleName) {
            $role = Role::create(array('name' => $roleName));
            $this->roleIds[$roleName] = $role->id;
        }
    }

    private function assignAdminPermissions()
    {
        $admin = Role::where('name', 'admin')
            ->first();

        $admin->perms()
            ->sync($this->adminPermissionIds);


        $readOnlyAdmin = Role::where('name', 'admin_read_only')
            ->first();

        $readOnlyAdmin->perms()
            ->sync($this->readOnlyPermissionIds);
    }
}
