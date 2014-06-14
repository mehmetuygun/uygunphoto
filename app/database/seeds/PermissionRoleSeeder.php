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

    public function run()
    {
        DB::table('permissions')->truncate();
        DB::table('permission_role')->truncate();
        DB::table('roles')->truncate();

        $this->createRoles();
        $this->createAdminPermissions();
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

            if ($mode != 'read') {
                DB::table('permission_role')->insert(array(
                    'permission_id' => $permission->id,
                    'role_id' => $this->roleIds['admin']
                ));
                continue;
            }

            DB::table('permission_role')->insert(array(
                'permission_id' => $permission->id,
                'role_id' => $this->roleIds['admin']
            ));
            DB::table('permission_role')->insert(array(
                'permission_id' => $permission->id,
                'role_id' => $this->roleIds['admin_read_only']
            ));
        }
    }

    private function createRoles()
    {
        foreach (self::$roleList as $roleName) {
            $role = Role::create(array('name' => $roleName));
            $this->roleIds[$roleName] = $role->id;
        }
    }
}
