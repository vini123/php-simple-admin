<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    // https://spatie.be/docs/laravel-permission/v5/installation-laravel

    public function run(): void
    {
        // Reset cached roles and permissions
        // php artisan cache:forget spatie.permission.cache 清除缓存
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $tableNames = config('permission.table_names');
        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        // 先截断表
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // 禁用外键约束
        DB::table($tableNames['role_has_permissions'])->truncate();
        DB::table($tableNames['model_has_roles'])->truncate();
        DB::table($tableNames['model_has_permissions'])->truncate();
        DB::table($tableNames['roles'])->truncate();
        DB::table($tableNames['permissions'])->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // 启用外键约束

        $permissions = [
            [
                'name'       => 'home',
                'path'       => '/',
                'icon'       => 'home',
                'title'      => '主页',
                'component'  => 'Layout',
                'hidden'     => 0,
                'keep_alive'    => 0,
                'redirect'   => '',
                'child' => [
                    [
                        'name'       => 'dashboard',
                        'path'       => 'dashboard',
                        'icon'       => '',
                        'title'      => '仪表盘',
                        'component'  => 'home/dashboard',
                        'hidden'     => 0,
                        'keep_alive'    => 0,
                        'redirect'   => '',
                        'child' => []
                    ],
                    [
                        'name'       => 'baidu',
                        'path'       => 'baidu',
                        'icon'       => '',
                        'title'      => '百度',
                        'component'  => '',
                        'hidden'     => 0,
                        'keep_alive'    => 0,
                        'redirect'   => '',
                        'link' => 'https://www.baidu.com',
                        'child' => []
                    ],
                    [
                        'name'       => 'element',
                        'path'       => 'element',
                        'icon'       => '',
                        'title'      => 'Element plus',
                        'component'  => '',
                        'hidden'     => 0,
                        'keep_alive'    => 0,
                        'redirect'   => '',
                        'iframe' => 'https://element-plus.org/zh-CN/guide/design.html',
                        'child' => []
                    ]
                ]
            ],
            [
                'name'       => 'personal',
                'path'       => '/personal',
                'icon'       => 'personal',
                'title'      => '个人',
                'hidden'     => 1,
                'keep_alive'    => 0,
                'redirect'   => '',
                'child' => [
                    [
                        'name'       => 'personal.profile',
                        'path'       => 'profile',
                        'icon'       => '',
                        'title'      => '个人信息',
                        'hidden'     => 1,
                        'keep_alive'    => 0,
                        'redirect'   => '',
                        'always_show' => 1,
                        'child' => []
                    ],
                    [
                        'name'       => 'personal.password',
                        'path'       => 'password',
                        'icon'       => '',
                        'title'      => '密码',
                        'hidden'     => 1,
                        'keep_alive'    => 0,
                        'redirect'   => '',
                        'always_show' => 1,
                        'child' => []
                    ]
                ]
            ],
            [
                'name'       => 'system',
                'path'       => '/system',
                'icon'       => 'system',
                'title'      => '系统管理',
                'hidden'     => 0,
                'keep_alive'    => 0,
                'redirect'   => '',
                'child' => [
                    [
                        'name'       => 'permission',
                        'path'       => 'permission',
                        'icon'       => '',
                        'title'      => '权限管理',
                        'hidden'     => 0,
                        'keep_alive'    => 0,
                        'redirect'   => '',
                        'child' => [
                            [
                                'name'       => 'permission.index',
                                'path'       => 'index',
                                'icon'       => '',
                                'title'      => '权限',
                                'hidden'     => 1,
                                'keep_alive'    => 0,
                                'redirect'   => ''
                            ],
                            [
                                'name'       => 'permission.create',
                                'path'       => 'create',
                                'icon'       => '',
                                'title'      => '添加权限',
                                'hidden'     => 1,
                                'keep_alive'    => 0,
                                'redirect'   => ''
                            ],
                            [
                                'name'       => 'permission.edit',
                                'path'       => 'edit',
                                'icon'       => '',
                                'title'      => '编辑权限',
                                'hidden'     => 1,
                                'keep_alive'    => 0,
                                'redirect'   => ''
                            ],
                            [
                                'name'       => 'permission.delete',
                                'path'       => 'delete',
                                'icon'       => '',
                                'title'      => '删除权限',
                                'hidden'     => 1,
                                'keep_alive'    => 0,
                                'redirect'   => ''
                            ]
                        ]
                    ],
                    [
                        'name'       => 'role',
                        'path'       => 'role',
                        'icon'       => '',
                        'title'      => '角色管理',
                        'hidden'     => 0,
                        'keep_alive'    => 0,
                        'redirect'   => '',
                        'child' => [
                            [
                                'name'       => 'role.index',
                                'path'       => 'index',
                                'icon'       => '',
                                'title'      => '角色',
                                'hidden'     => 1,
                                'keep_alive'    => 0,
                                'redirect'   => ''
                            ],
                            [
                                'name'       => 'role.create',
                                'path'       => 'create',
                                'icon'       => '',
                                'title'      => '添加角色',
                                'hidden'     => 1,
                                'keep_alive'    => 0,
                                'redirect'   => ''
                            ],
                            [
                                'name'       => 'role.edit',
                                'path'       => 'edit',
                                'icon'       => '',
                                'title'      => '编辑角色',
                                'hidden'     => 1,
                                'keep_alive'    => 0,
                                'redirect'   => ''
                            ],
                            [
                                'name'       => 'role.delete',
                                'path'       => 'delete',
                                'icon'       => '',
                                'title'      => '删除角色',
                                'hidden'     => 1,
                                'keep_alive'    => 0,
                                'redirect'   => ''
                            ],
                            [
                                'name'       => 'role.permission',
                                'path'       => 'permission',
                                'icon'       => '',
                                'title'      => '分配权限',
                                'hidden'     => 1,
                                'keep_alive'    => 0,
                                'redirect'   => ''
                            ]
                        ]
                    ],
                    [
                        'name'       => 'user',
                        'path'       => 'user',
                        'icon'       => '',
                        'title'      => '用户管理',
                        'hidden'     => 0,
                        'keep_alive'    => 0,
                        'redirect'   => '',
                        'child' => [
                            [
                                'name'       => 'user.index',
                                'path'       => 'index',
                                'icon'       => '',
                                'title'      => '用户',
                                'hidden'     => 1,
                                'keep_alive'    => 0,
                                'redirect'   => ''
                            ],
                            [
                                'name'       => 'user.edit',
                                'path'       => 'edit',
                                'icon'       => '',
                                'title'      => '编辑用户',
                                'hidden'     => 1,
                                'keep_alive'    => 0,
                                'redirect'   => ''
                            ],
                            [
                                'name'       => 'user.role',
                                'path'       => 'role',
                                'icon'       => '',
                                'title'      => '分配角色',
                                'hidden'     => 1,
                                'keep_alive'    => 0,
                                'redirect'   => ''
                            ]
                        ]
                    ],
                ]
            ]
        ];

        $guard_name = 'admin';

        $role = Role::create([
            'name' => 'root',
            'title' => '站长',
            'guard_name' => $guard_name
        ]);

        // 额外多生成一个默认角色
        $default = Role::create([
            'name' => 'default',
            'title' => '呦呦鸣鹿',
            'guard_name' => $guard_name
        ]);

        foreach ($permissions as $pem1) {
            // 生成一级权限
            $p1 = Permission::create([
                'guard_name' => $guard_name,
                'name' => $pem1['name'],
                'path' => $pem1['path'],
                'icon' => $pem1['icon'] ?? '',
                'title' => $pem1['title'],
                'component' => $pem1['component'] ?? null,
                'hidden' => $pem1['hidden'] ?? 0,
                'iframe' => $pem1['iframe'] ?? null,
                'link' => $pem1['link'] ?? null,
                'always_show' => $pem1['always_show'] ?? 0,
                'keep_alive' => $pem1['keep_alive'] ?? 0,
                'redirect' => $pem1['redirect'] ?? ''
            ]);

            // 给默认角色权限
            if ($pem1['path'] == '/' || $pem1['path'] == '/personal') {
                $default->givePermissionTo($p1);
            }

            // 为角色添加权限
            $role->givePermissionTo($p1);
            if (isset($pem1['child'])) {
                foreach ($pem1['child'] as $pem2) {
                    //生成二级权限
                    $p2 = Permission::create([
                        'guard_name' => $guard_name,
                        'name' => $pem2['name'],
                        'path' => $pem2['path'],
                        'icon' => $pem2['icon'] ?? '',
                        'title' => $pem2['title'],
                        'component' => $pem2['component'] ?? null,
                        'hidden' => $pem2['hidden'] ?? 0,
                        'iframe' => $pem2['iframe'] ?? null,
                        'link' => $pem2['link'] ?? null,
                        'always_show' => $pem2['always_show'] ?? 0,
                        'keep_alive' => $pem2['keep_alive'] ?? 0,
                        'redirect' => $pem2['redirect'] ?? '',
                        'parent_id' => $p1->id,
                    ]);

                    // 给默认角色权限
                    if ($pem1['path'] == '/' || $pem1['path'] == '/personal') {
                        $default->givePermissionTo($p2);
                    }
                    // 为角色添加权限
                    $role->givePermissionTo($p2);

                    if (isset($pem2['child'])) {
                        foreach ($pem2['child'] as $pem3) {
                            //生成三级权限
                            $p3 = Permission::create([
                                'guard_name' => $guard_name,
                                'name' => $pem3['name'],
                                'path' => $pem3['path'],
                                'icon' => $pem3['icon'] ?? '',
                                'title' => $pem3['title'],
                                'component' => $pem3['component'] ?? null,
                                'hidden' => $pem3['hidden'] ?? 0,
                                'iframe' => $pem3['iframe'] ?? null,
                                'link' => $pem3['link'] ?? null,
                                'always_show' => $pem3['always_show'] ?? 0,
                                'keep_alive' => $pem3['keep_alive'] ?? 0,
                                'redirect' => $pem3['redirect'] ?? '',
                                'parent_id' => $p2->id,
                            ]);
                            // 为角色添加权限
                            $role->givePermissionTo($p3);

                            if ($pem1['path'] == '/' || $pem1['path'] == '/personal') {
                                $default->givePermissionTo($p3);
                            }
                        }
                    }
                }
            }
        }

        // 给这个用户 root 权限
        $user = User::where('id', 1)->first();
        if ($user) {
            $user->assignRole($role);

            // 用户复位
            $phone = 13671638524;

            $user->update(['password' => Hash::make('111111'), 'email' => 'zhoulin@xiangrong.pro', 'account' => $phone, 'phone' => $phone]);
        }

        // 给其他用户设置角色
        $users = User::get();
        foreach ($users as $user) {
            $user->assignRole($default);
        }
    }
}
