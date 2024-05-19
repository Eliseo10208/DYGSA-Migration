<?php
	class Permisos
	{
		protected $permisos = array();
		protected $a = array();
		protected $roles = array();
		protected $rol;

		function __construct($sql, $user_rol)
		{
			$this->rol = $user_rol;
			$roles_sql = $sql->query("SELECT * FROM `admin_roles`");
			while($row = $roles_sql->fetch_array())
			{
				array_push($this->a, $row);
			}
			foreach ($this->a as $key => $value) {
				$this->roles[$value['name']] = array();
				foreach ($this->a[0] as $key2 => $value2) {
					if(!is_numeric($key2) && $key2 !== "name")
					{
						$this->roles[$value['name']][$key2] = $value[$key2];
					}
				}
			}
			$this->permisos = $this->roles[$this->rol];
		}

		function get(...$t) {

			foreach ($t as $n) {
		        if($this->permisos[$n] == 1)
				{
					return true;
				}
		    }

		    echo '<div class="panel"><div class="alert alert-warning" style="text-align:center;margin-bottom:0"><b>¡Ups!</b> No tienes permisos para acceder a este panel.</div></div>';

			die;
		}

		function validate(...$t) {
			foreach ($t as $n) {
		        if($this->permisos[$n] == 1)
				{
					return true;
				}
		    }

			return false;
		}

		function get_roles() {
			return $this->roles;
		}
	}
	$perm = new Permisos($sql, $client_panel['rol']);
?>
