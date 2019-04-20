<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class UsersTableSeeder extends Seeder
{
	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->create_user_roles();
        $this->create_user_permissions();
        $this->assign_permissions_to_role();
        $this->create_users();
    }

    protected function create_user($user_name, $user_email, $user_password="password", $user_role="guest", $user_status="publish")
    {

        $user = new User();
        try{
            $user = $user->create([
                'name' => $user_name,
                'email' => $user_email,
                'password' => bcrypt($user_password),
                'user_status' => 'publish'
            ]);
            $user->assignRole($user_role);
            $user->setMeta('content', 'Some content here');
            // $user->save();

        } catch (Exception $e) {
            $user = null;
        }
        return $user;
    }

    protected function create_role($role_name)
    {
        try{
            $role = Role::create(['name' => $role_name]);
        } catch (Exception $e) {
            $role = null;
        }
        return $role;
    }

    protected function create_permission($permission_name)
    {
        try{
            $permission = Permission::create(['name' => $permission_name]);
        } catch (Exception $e) {
            $permission = null;
        }
        return $permission;
    }

	public function create_user_roles()
    {
        $this->super_admin = $this->create_role('super-admin');
        $this->admin = $this->create_role('admin');
        $this->support = $this->create_role('support');
        $this->general = $this->create_role('general');
	}
    
    public function create_user_permissions()
    {
            // Super Admin Permissions
            Permission::create(['name' => 'create_sites']);
            Permission::create(['name' => 'delete_sites']);
            Permission::create(['name' => 'manage_network']);
            Permission::create(['name' => 'manage_sites']);
            Permission::create(['name' => 'manage_network_users']);
            Permission::create(['name' => 'manage_network_plugins']);
            Permission::create(['name' => 'manage_network_themes']);
            Permission::create(['name' => 'manage_network_options']);
            Permission::create(['name' => 'upload_themes']);
            Permission::create(['name' => 'upgrade_network']);
            Permission::create(['name' => 'setup_network']);
        
            // Admin Permissions
            Permission::create(['name' => 'create_users']);
            Permission::create(['name' => 'delete_themes']);
            Permission::create(['name' => 'delete_users']);
            Permission::create(['name' => 'edit_files']);
            Permission::create(['name' => 'edit_plugins']);
            Permission::create(['name' => 'edit_theme_options']);
            Permission::create(['name' => 'edit_themes']);
            Permission::create(['name' => 'edit_users']);
            Permission::create(['name' => 'export']);
            Permission::create(['name' => 'import']);
            Permission::create(['name' => 'install_themes']);
            Permission::create(['name' => 'list_users']);
            Permission::create(['name' => 'manage_options']);
            Permission::create(['name' => 'promote_users']);
            Permission::create(['name' => 'remove_users']);
            Permission::create(['name' => 'switch_themes']);
            Permission::create(['name' => 'update_core']);
            Permission::create(['name' => 'update_themes']);
            Permission::create(['name' => 'edit_dashboard']);
            Permission::create(['name' => 'customize']);
            Permission::create(['name' => 'delete_site']);

            // Support User Permissions
            Permission::create(['name' => 'moderate_comments']);
            Permission::create(['name' => 'manage_categories']);
            Permission::create(['name' => 'manage_links']);
            Permission::create(['name' => 'edit_others_posts']);
            Permission::create(['name' => 'edit_pages']);
            Permission::create(['name' => 'edit_others_pages']);
            Permission::create(['name' => 'edit_published_pages']);
            Permission::create(['name' => 'publish_pages']);
            Permission::create(['name' => 'delete_pages']);
            Permission::create(['name' => 'delete_others_pages']);
            Permission::create(['name' => 'delete_published_pages']);
            Permission::create(['name' => 'delete_others_posts']);
            Permission::create(['name' => 'delete_private_posts']);
            Permission::create(['name' => 'edit_private_posts']);
            Permission::create(['name' => 'read_private_posts']);
            Permission::create(['name' => 'delete_private_pages']);
            Permission::create(['name' => 'edit_private_pages']);
            Permission::create(['name' => 'read_private_pages']);
            Permission::create(['name' => 'unfiltered_html']);

            // General User Permissions
            Permission::create(['name' => 'edit_published_posts']);
            Permission::create(['name' => 'upload_files']);
            Permission::create(['name' => 'publish_posts']);
            Permission::create(['name' => 'delete_published_posts']);
            Permission::create(['name' => 'edit_posts']);
            Permission::create(['name' => 'delete_posts']);
            Permission::create(['name' => 'read']);
    }

    public function super_admin_permissions()
    {
        $result = [
            // Super Admin Permissions
            'create_sites',
            'delete_sites',
            'manage_network',
            'manage_sites',
            'manage_network_users',
            'manage_network_plugins',
            'manage_network_themes',
            'manage_network_options',
            'upload_themes',
            'upgrade_network',
            'setup_network',
        
            // Admin Permissions
            'create_users',
            'delete_themes',
            'delete_users',
            'edit_files',
            'edit_theme_options',
            'edit_themes',
            'edit_users',
            'export',
            'import',
            'install_themes',
            'list_users',
            'manage_options',
            'promote_users',
            'remove_users',
            'switch_themes',
            'update_core',
            'update_themes',
            'edit_dashboard',
            'customize',
            'delete_site',

            // Support User Permissions
            'moderate_comments',
            'manage_categories',
            'manage_links',
            'edit_others_posts',
            'edit_pages',
            'edit_others_pages',
            'edit_published_pages',
            'publish_pages',
            'delete_pages',
            'delete_others_pages',
            'delete_published_pages',
            'delete_others_posts',
            'delete_private_posts',
            'edit_private_posts',
            'read_private_posts',
            'delete_private_pages',
            'edit_private_pages',
            'read_private_pages',
            'unfiltered_html',

            // General User Permissions
            'edit_published_posts',
            'upload_files',
            'publish_posts',
            'delete_published_posts',
            'edit_posts',
            'delete_posts',
            'read',
        ];
        return $result;
    }

    private function admin_permissions(){
         $result = [
            // Admin Permissions
            'create_users',
            'delete_themes',
            'delete_users',
            'edit_files',
            'edit_theme_options',
            'edit_themes',
            'edit_users',
            'export',
            'import',
            'install_themes',
            'list_users',
            'manage_options',
            'promote_users',
            'remove_users',
            'switch_themes',
            'update_core',
            'update_themes',
            'edit_dashboard',
            'customize',
            'delete_site',

            // Support User Permissions
            'moderate_comments',
            'manage_categories',
            'manage_links',
            'edit_others_posts',
            'edit_pages',
            'edit_others_pages',
            'edit_published_pages',
            'publish_pages',
            'delete_pages',
            'delete_others_pages',
            'delete_published_pages',
            'delete_others_posts',
            'delete_private_posts',
            'edit_private_posts',
            'read_private_posts',
            'delete_private_pages',
            'edit_private_pages',
            'read_private_pages',
            'unfiltered_html',

            // General User Permissions
            'edit_published_posts',
            'upload_files',
            'publish_posts',
            'delete_published_posts',
            'edit_posts',
            'delete_posts',
            'read',
        ];
        return $result;
    }

    private function support_user_permissions(){
         $result = [
            // Support User Permissions
            'moderate_comments',
            'manage_categories',
            'manage_links',
            'edit_others_posts',
            'edit_pages',
            'edit_others_pages',
            'edit_published_pages',
            'publish_pages',
            'delete_pages',
            'delete_others_pages',
            'delete_published_pages',
            'delete_others_posts',
            'delete_private_posts',
            'edit_private_posts',
            'read_private_posts',
            'delete_private_pages',
            'edit_private_pages',
            'read_private_pages',
            'unfiltered_html',

            // General User Permissions
            'edit_published_posts',
            'upload_files',
            'publish_posts',
            'delete_published_posts',
            'edit_posts',
            'delete_posts',
            'read',
        ];
        return $result;
    }

    private function general_user_permissions(){
        $result =[
                // General User Permissions
                'edit_published_posts',
                'upload_files',
                'publish_posts',
                'delete_published_posts',
                'edit_posts',
                'delete_posts',
                'read',
        ];
        return $result;
    }

    
    public function assign_permissions_to_role()
    {
        $this->super_admin->syncPermissions($this->super_admin_permissions());
        $this->admin->syncPermissions($this->admin_permissions());
        $this->support->syncPermissions($this->support_user_permissions());
        $this->general->syncPermissions($this->general_user_permissions());
    }
	public function create_users()
    {
		$this->create_user('Mary June','maryjune@gmail.com','password','super-admin', 'publish');
        $this->create_user('Harry Patter','harrypatter@gmail.com','password','guest-user', 'publish');
        $this->create_user('Levi Strange','levi.strange@clickon.co','password','super-admin', 'publish');
        $this->create_user('Juha-Pekka Ylisela','juha-pekka.ylisela@clickon.co','password','general-user', 'publish');
        $this->create_user('Richard Wilson','richard.wilson@clickon.co','password','super-admin', 'publish');
        $this->create_user('Farris Salah','farris.salah@clickon.co','password','super-admin', 'publish');
        $this->create_user('Phil Trevillion','phillip.trevillion@clickon.co','password','admin', 'publish');
        $this->create_user('Einar Randall','EinarRandall@gmail.com','password','guest-user', 'publish');
        $this->create_user('Chetan Mohamed','ChetanMohamed@gmail.com','password','basic-user', 'publish');
        $this->create_user('Derick Maximinus','DerickMaximinus@gmail.com','password','general-user', 'publish');
        $this->create_user('Adrian Goris','adrian.goris@clickon.co','password','admin', 'publish');
        $this->create_user('Iwan Owen','IwanOwen@fakeAgency.com','password','external-basic-user', 'publish');
        $this->create_user('Maria Bennett','MariaBennett@fakeAgency.com','password','external-general-user', 'publish');
        $this->create_user('Donald Glover','DonaldGlover@fakeAgency.com','password','external-pro-user', 'publish');
    }
}