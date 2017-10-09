<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();

  //      		Model::unguard();
        		//insertamos los usuarios
        		$this->call('UserTableSeeder');
            $this->call('UsuariosDetailTableSeeder');
            $this->call('usuariosPerfil');
            $this->call('usuariosPuesto');
            $this->call('menuizquierda');
            $this->call('submenuizquierda');
            $this->call('permisosMenu');
            $this->call('permisosSubmenu');
            $this->call('campanas');
            $this->call('dispositions');
            $this->call('dispositionsPlan');
            $this->call('dispositionsPlandetail');
            $this->call('tipoInteraccion');
            $this->call('clientes');
            $this->call('clientesDetail');
            $this->command->info('User table seeded');

        //Model::reguard();
    }
}


    class UserTableSeeder extends Seeder {

        public function run()
        {

          db::table('Users')->insert(array(
                   'usuario'     => 'jorge.chavez@overthetop.com.mx',
                   'email'     => 'jorge.chavez@overthetop.com.mx',
                   'password'    =>  Hash::make('jorge.chavez'),
                   'habilitado'  =>  1,
                   'id_usuariosPerfil' =>  1,
                   'id_usuariosPuesto' => 1,
                 ));

         db::table('Users')->insert(array(
                  'usuario'     => 'jchavzr@gmail.com',
                  'email'     => 'jchavzr@gmail.com',
                  'password'    =>  Hash::make('jorge.chavez'),
                  'habilitado'  =>  1,
                  'id_usuariosPerfil' =>  2,
                  'id_usuariosPuesto' => 2,
                ));


        }
      }


        class UsuariosDetailTableSeeder extends Seeder {

            public function run()
            {

              db::table('usuariosDetail')->insert(array(
                       'nombre'     => 'Jorge',
                       'apellidoPaterno'  =>  'Chavez',
                       'apellidoMaterno'  =>  'Ruiz',
                       'domicilioCalle' =>  'Texihuatla 1038',
                       'domicilioColonia' =>  'Fracc. Revolucion',
                       'domicilioCiudad' =>  'Tlaquepaque',
                       'domicilioCP' =>  '45580',
                       'fechaNacimiento' =>  '1983-12-26',
                       'sexo' => 1,
                       'curp' => 'CARJ831226HJCHZR08',
                       'rfc' => 'CARJ831226JE4',
                       'nss' => '04048373502',
                       'fechaIngreso' =>  '2017-09-01',
                       'id_usuario' => 1,

                     ));

               db::table('usuariosDetail')->insert(array(
                        'nombre'     => 'Jorge',
                        'apellidoPaterno'  =>  'Chavez',
                        'apellidoMaterno'  =>  'Ruiz',
                        'domicilioCalle' =>  'Texihuatla 1038',
                        'domicilioColonia' =>  'Fracc. Revolucion',
                        'domicilioCiudad' =>  'Tlaquepaque',
                        'domicilioCP' =>  '45580',
                        'fechaNacimiento' =>  '1983-12-26',
                        'sexo' => 1,
                        'curp' => 'CARJ831226HJCHZR08',
                        'rfc' => 'CARJ831226JE4',
                        'nss' => '04048373502',
                        'fechaIngreso' =>  '2017-09-01',
                        'id_usuario' => 2,

                      ));


            }
          }


        class usuariosPerfil extends Seeder {

            public function run()
            {



              db::table('usuariosPerfil')->insert(array(
                       'perfil'     => 'Super Admin',
                     ));

             db::table('usuariosPerfil')->insert(array(
                      'perfil'     => 'Ejecutivo Cobro',
                    ));

            }
          }

          class usuariosPuesto extends Seeder {

              public function run()
              {
                db::table('usuariosPuesto')->insert(array(
                         'puesto'     => 'Director de Desarrollo',
                       ));

                db::table('usuariosPuesto')->insert(array(
                         'puesto'     => 'Ejecutivo Cobro',
                       ));

              }
            }

            class menuizquierda extends Seeder {

                public function run()
                {

                  db::table('menuIzquierda')->insert(array(
                           'opcion'     => 'HRM (Administracion de recursos humanos)',
                           'icono'     => 'fa fa-user',
                           'route'     => '#',
                           'consubmenu'     => '1',
                         ));

                 db::table('menuIzquierda')->insert(array(
                          'opcion'     => 'CRM (Administracion de relacion con el cliente)',
                          'icono'     => 'fa fa-users',
                          'route'     => '#',
                          'consubmenu'     => '1',
                        ));

                db::table('menuIzquierda')->insert(array(
                         'opcion'     => 'Administracion de la Herramienta',
                         'icono'     => 'fa fa-gear',
                         'route'     => '#',
                         'consubmenu'     => '1',
                       ));

                }
              }

              class submenuizquierda extends Seeder {

                  public function run()
                  {

                    db::table('submenuIzquierda')->insert(array(
                             'opcion'     => 'Crear perfil Usuario',
                             'route'     => '/newprofileuser',
                             'id_menuIzquierda' => 1
                           ));

                     db::table('submenuIzquierda')->insert(array(
                              'opcion'     => 'Ver / editar perfiles de usuarios',
                              'route'     => '/editprofileuser',
                              'id_menuIzquierda' => 1
                          ));

                    db::table('submenuIzquierda')->insert(array(
                             'opcion'     => 'Ver cliente',
                             'route'     => '/crmindex',
                             'id_menuIzquierda' => 2
                       ));

                    db::table('submenuIzquierda')->insert(array(
                             'opcion'     => 'Crear usuario',
                             'route'     => '/newuser',
                             'id_menuIzquierda' => 3
                         ));


                    db::table('submenuIzquierda')->insert(array(
                             'opcion'     => 'Crear perfil de seguridad',
                             'route'     => '/nuevoperfilseguridad',
                             'id_menuIzquierda' => 3
                         ));

                   db::table('submenuIzquierda')->insert(array(
                            'opcion'     => 'Ver / editar perfil de seguridad',
                            'route'     => '/editperfilseguridadshow',
                            'id_menuIzquierda' => 3
                        ));

                   db::table('submenuIzquierda')->insert(array(
                            'opcion'     => 'Agendas / compromisos',
                            'route'     => '/controlcompromisos',
                            'id_menuIzquierda' => 2
                       ));

                  }
                }


              class permisosMenu extends Seeder {

                    public function run()
                    {

                      db::table('permisosMenu')->insert(array(
                               'id_perfil'     => 1,
                               'id_menuIzquierda' => 1
                             ));

                       db::table('permisosMenu')->insert(array(
                                'id_perfil'     => 1,
                                'id_menuIzquierda' => 2
                              ));

                       db::table('permisosMenu')->insert(array(
                                       'id_perfil'     => 1,
                                       'id_menuIzquierda' => 3
                                     ));

                       db::table('permisosMenu')->insert(array(
                                       'id_perfil'     => 2,
                                       'id_menuIzquierda' => 2
                                     ));

                    }
                  }

                  class permisosSubmenu extends Seeder {

                        public function run()
                        {

                          db::table('permisosSubmenu')->insert(array(
                                   'id_permisosMenu'     => 1,
                                   'id_perfil'     => 1,
                                   'id_submenuIzquierda' => 1
                                 ));

                           db::table('permisosSubmenu')->insert(array(
                                    'id_permisosMenu'     => 1,
                                    'id_perfil'     => 1,
                                    'id_submenuIzquierda' => 2
                                  ));

                          db::table('permisosSubmenu')->insert(array(
                                   'id_permisosMenu'     => 2,
                                   'id_perfil'     => 1,
                                   'id_submenuIzquierda' => 3
                                 ));

                         db::table('permisosSubmenu')->insert(array(
                                  'id_permisosMenu'     => 3,
                                  'id_perfil'     => 1,
                                  'id_submenuIzquierda' => 4
                                ));

                        db::table('permisosSubmenu')->insert(array(
                                 'id_permisosMenu'     => 3,
                                 'id_perfil'     => 1,
                                 'id_submenuIzquierda' => 5
                               ));


                       db::table('permisosSubmenu')->insert(array(
                                'id_permisosMenu'     => 3,
                                'id_perfil'     => 1,
                                'id_submenuIzquierda' => 6
                              ));

                          db::table('permisosSubmenu')->insert(array(
                                  'id_permisosMenu'     => 4,
                                  'id_perfil'     => 2,
                                  'id_submenuIzquierda' => 3
                                        ));

                      db::table('permisosSubmenu')->insert(array(
                              'id_permisosMenu'     => 2,
                              'id_perfil'     => 1,
                              'id_submenuIzquierda' => 7
                                    ));

                        }
                      }



                  class campanas extends Seeder {

                      public function run()
                      {
                        db::table('campanas')->insert(array(
                                 'nombre'       => 'Cobro de Tarjeta de credito',
                                 'descripcion'  => 'Cobro de Tarjeta de credito',
                                 'id_compania'  => 1,
                                 'id_dispositionPlan'  => 1,
                               ));

                      }
                    }


                    class dispositions extends Seeder {

                        public function run()
                        {
                          db::table('dispositions')->insert(array(
                                   'nombre'       => 'No contesta',
                                   'contacto'  => 0,
                                   'rpc'  => 0,
                                   'exito'  => 0,
                                   'compromiso'  => 0,
                                   'bloqueo'  => 0,
                                 ));

                           db::table('dispositions')->insert(array(
                                    'nombre'       => 'No vive ahi',
                                    'contacto'  => 1,
                                    'rpc'  => 0,
                                    'exito'  => 0,
                                    'compromiso'  => 0,
                                    'bloqueo'  => 0,
                                  ));

                            db::table('dispositions')->insert(array(
                                     'nombre'       => 'Se deja recado',
                                     'contacto'  => 1,
                                     'rpc'  => 0,
                                     'exito'  => 0,
                                     'compromiso'  => 0,
                                     'bloqueo'  => 0,
                                   ));

                             db::table('dispositions')->insert(array(
                                      'nombre'       => 'No confirma pago',
                                      'contacto'  => 1,
                                      'rpc'  => 1,
                                      'exito'  => 0,
                                      'compromiso'  => 0,
                                      'bloqueo'  => 0,
                                    ));

                              db::table('dispositions')->insert(array(
                                       'nombre'       => 'Agenda',
                                       'contacto'  => 1,
                                       'rpc'  => 1,
                                       'exito'  => 0,
                                       'compromiso'  => 1,
                                       'bloqueo'  => 0,
                                   ));

                               db::table('dispositions')->insert(array(
                                        'nombre'       => 'Promesa de pago',
                                        'contacto'  => 1,
                                        'rpc'  => 1,
                                        'exito'  => 1,
                                        'compromiso'  => 1,
                                        'bloqueo'  => 1,
                                    ));
                        }
                      }



                      class dispositionsPlan extends Seeder {

                          public function run()
                          {
                            db::table('dispositionplan')->insert(array(
                                     'nombre'       => 'Cobro de Tarjeta de credito codigos',
                                     'descripcion'  => 'Cobro de Tarjeta de credito codigos',
                                     'id_compania'  => 1,
                                   ));

                          }
                        }


                        class dispositionsPlandetail extends Seeder {

                            public function run()
                            {
                              db::table('dispositionplandetail')->insert(array(
                                       'id_dispositionPlan'      => 1,
                                       'id_disposition'          => 1,
                                     ));

                               db::table('dispositionplandetail')->insert(array(
                                        'id_dispositionPlan'      => 1,
                                        'id_disposition'          => 2,
                                      ));

                                db::table('dispositionplandetail')->insert(array(
                                         'id_dispositionPlan'      => 1,
                                         'id_disposition'          => 3,
                                       ));
                                 db::table('dispositionplandetail')->insert(array(
                                          'id_dispositionPlan'      => 1,
                                          'id_disposition'          => 4,
                                        ));
                                db::table('dispositionplandetail')->insert(array(
                                         'id_dispositionPlan'      => 1,
                                         'id_disposition'          => 5,
                                       ));
                                 db::table('dispositionplandetail')->insert(array(
                                          'id_dispositionPlan'      => 1,
                                          'id_disposition'          => 6,
                                        ));
                            }
                          }


                    class tipoInteraccion extends Seeder {

                        public function run()
                        {
                          db::table('tipoInteraccion')->insert(array(
                                   'tipo'       => 'LS',
                                   'descripcion'  => 'Llamada saliente',
                                 ));

                           db::table('tipoInteraccion')->insert(array(
                                    'tipo'       => 'LE',
                                    'descripcion'  => 'Llamada entrante',
                                  ));

                        }
                      }


                      class clientes extends Seeder {

                            public function run()
                            {

                              db::table('clientes')->insert(array(
                                       'customerid'     => 1,
                                       'idcampana'      => 1,
                                     ));

                             db::table('clientes')->insert(array(
                                      'customerid'     => 2,
                                      'idcampana'      => 1,
                                    ));

                            db::table('clientes')->insert(array(
                                     'customerid'     => 3,
                                     'idcampana'      => 1,
                                   ));

                           db::table('clientes')->insert(array(
                                    'customerid'     => 4,
                                    'idcampana'      => 1,
                                  ));

                            db::table('clientes')->insert(array(
                                     'customerid'     => 5,
                                     'idcampana'      => 1,
                                   ));

                             db::table('clientes')->insert(array(
                                      'customerid'     => 6,
                                        'idcampana'    => 1,
                                    ));

                            db::table('clientes')->insert(array(
                                     'customerid'     => 7,
                                       'idcampana'    => 1,
                                   ));

                             db::table('clientes')->insert(array(
                                      'customerid'     => 8,
                                        'idcampana'    => 1,
                                    ));

                              db::table('clientes')->insert(array(
                                       'customerid'     => 9,
                                         'idcampana'    => 1,
                                     ));

                             db::table('clientes')->insert(array(
                                      'customerid'     => 10,
                                        'idcampana'    => 1,
                                    ));

                            }
                          }



                          class clientesDetail extends Seeder {

                                public function run()
                                {

                                  db::table('clientesdetail')->insert(array(
                                           'customerid'     => 1,
                                           'nombreCliente'   => 'Jorge Chavez Ruiz',
                                           'calleCasa'       => 'xxxx no 00',
                                           'coloniaCasa'     => 'yyyy',
                                           'ciudadCasa'      => 'Guadalajara',
                                           'cpCasa'          => '44444',
                                           'calleTrabajo'    => 'gggg no 01',
                                           'coloniaTrabajo'  => 'hhhh',
                                           'ciudadTrabajo'   => 'Guadalajara',
                                           'cpTrabajo'       => '44444',
                                           'telefono1'       => '1111111111',
                                           'telefono2'       => '2222222222',
                                           'telefono3'       => '3333333333',
                                           'telefono4'       => '4444444444',
                                           'custom1'         => '10000',
                                           'custom2'         => 'estos',
                                           'custom3'         => 'campos',
                                           'custom4'         => 'pueden',
                                           'custom5'         => 'alojar',
                                           'custom6'         => 'otro',
                                           'custom7'         => 'tipo',
                                           'custom8'         => 'de',
                                           'custom9'         => 'informacion',
                                           'custom10'         => '!!!',
                                         ));

                                 db::table('clientesdetail')->insert(array(
                                          'customerid'     => 2,
                                          'nombreCliente'   => 'aaaaaaaaaa',
                                          'calleCasa'       => 'aaaa no 00',
                                          'coloniaCasa'     => 'bbbb',
                                          'ciudadCasa'      => 'Guadalajara',
                                          'cpCasa'          => '44444',
                                          'calleTrabajo'    => 'cccc no 01',
                                          'coloniaTrabajo'  => 'dddd',
                                          'ciudadTrabajo'   => 'Guadalajara',
                                          'cpTrabajo'       => '44444',
                                          'telefono1'       => '1111111111',
                                          'telefono2'       => '2222222222',
                                          'telefono3'       => '3333333333',
                                          'telefono4'       => '4444444444',
                                          'custom1'         => '10000',
                                          'custom2'         => 'estos',
                                          'custom3'         => 'campos',
                                          'custom4'         => 'pueden',
                                          'custom5'         => 'alojar',
                                          'custom6'         => 'otro',
                                          'custom7'         => 'tipo',
                                          'custom8'         => 'de',
                                          'custom9'         => 'informacion',
                                          'custom10'         => '++++',
                                        ));

                                  db::table('clientesdetail')->insert(array(
                                           'customerid'     => 3,
                                           'nombreCliente'   => 'bbbbbbbbbb',
                                           'calleCasa'       => 'eeee no 00',
                                           'coloniaCasa'     => 'hhhhh',
                                           'ciudadCasa'      => 'Guadalajara',
                                           'cpCasa'          => '44444',
                                           'calleTrabajo'    => 'iiiii no 01',
                                           'coloniaTrabajo'  => 'jjjjj',
                                           'ciudadTrabajo'   => 'Guadalajara',
                                           'cpTrabajo'       => '44444',
                                           'telefono1'       => '1111111111',
                                           'telefono2'       => '2222222222',
                                           'telefono3'       => '3333333333',
                                           'telefono4'       => '4444444444',
                                           'custom1'         => '10000',
                                           'custom2'         => 'estos',
                                           'custom3'         => 'campos',
                                           'custom4'         => 'pueden',
                                           'custom5'         => 'alojar',
                                           'custom6'         => 'otro',
                                           'custom7'         => 'tipo',
                                           'custom8'         => 'de',
                                           'custom9'         => 'informacion',
                                           'custom10'         => '***',
                                         ));
                                   db::table('clientesdetail')->insert(array(
                                            'customerid'     => 4,
                                            'nombreCliente'   => 'cccccccccc',
                                            'calleCasa'       => 'kkkk no 00',
                                            'coloniaCasa'     => 'llll',
                                            'ciudadCasa'      => 'Guadalajara',
                                            'cpCasa'          => '44444',
                                            'calleTrabajo'    => 'mmmm no 01',
                                            'coloniaTrabajo'  => 'nnnn',
                                            'ciudadTrabajo'   => 'Guadalajara',
                                            'cpTrabajo'       => '44444',
                                            'telefono1'       => '1111111111',
                                            'telefono2'       => '2222222222',
                                            'telefono3'       => '3333333333',
                                            'telefono4'       => '4444444444',
                                            'custom1'         => '10000',
                                            'custom2'         => 'estos',
                                            'custom3'         => 'campos',
                                            'custom4'         => 'pueden',
                                            'custom5'         => 'alojar',
                                            'custom6'         => 'otro',
                                            'custom7'         => 'tipo',
                                            'custom8'         => 'de',
                                            'custom9'         => 'informacion',
                                            'custom10'         => '####',
                                          ));

                                    db::table('clientesdetail')->insert(array(
                                             'customerid'     => 5,
                                             'nombreCliente'   => 'dddddddddd',
                                             'calleCasa'       => 'oooo no 00',
                                             'coloniaCasa'     => 'pppp',
                                             'ciudadCasa'      => 'Guadalajara',
                                             'cpCasa'          => '44444',
                                             'calleTrabajo'    => 'qqqqq no 01',
                                             'coloniaTrabajo'  => 'rrrrr',
                                             'ciudadTrabajo'   => 'Guadalajara',
                                             'cpTrabajo'       => '44444',
                                             'telefono1'       => '1111111111',
                                             'telefono2'       => '2222222222',
                                             'telefono3'       => '3333333333',
                                             'telefono4'       => '4444444444',
                                             'custom1'         => '10000',
                                             'custom2'         => 'estos',
                                             'custom3'         => 'campos',
                                             'custom4'         => 'pueden',
                                             'custom5'         => 'alojar',
                                             'custom6'         => 'otro',
                                             'custom7'         => 'tipo',
                                             'custom8'         => 'de',
                                             'custom9'         => 'informacion',
                                             'custom10'         => '$$$$',
                                           ));


                                   db::table('clientesdetail')->insert(array(
                                            'customerid'     => 6,
                                            'nombreCliente'   => 'eeeeeeeeee',
                                            'calleCasa'       => 'sssss no 00',
                                            'coloniaCasa'     => 'ttttt',
                                            'ciudadCasa'      => 'Guadalajara',
                                            'cpCasa'          => '44444',
                                            'calleTrabajo'    => 'uuuuu no 01',
                                            'coloniaTrabajo'  => 'vvvvv',
                                            'ciudadTrabajo'   => 'Guadalajara',
                                            'cpTrabajo'       => '44444',
                                            'telefono1'       => '1111111111',
                                            'telefono2'       => '2222222222',
                                            'telefono3'       => '3333333333',
                                            'telefono4'       => '4444444444',
                                            'custom1'         => '10000',
                                            'custom2'         => 'estos',
                                            'custom3'         => 'campos',
                                            'custom4'         => 'pueden',
                                            'custom5'         => 'alojar',
                                            'custom6'         => 'otro',
                                            'custom7'         => 'tipo',
                                            'custom8'         => 'de',
                                            'custom9'         => 'informacion',
                                            'custom10'         => '%%%',
                                          ));

                                  db::table('clientesdetail')->insert(array(
                                           'customerid'     => 7,
                                           'nombreCliente'   => 'ffffffffff',
                                           'calleCasa'       => 'wwww no 00',
                                           'coloniaCasa'     => 'xxxx',
                                           'ciudadCasa'      => 'Guadalajara',
                                           'cpCasa'          => '44444',
                                           'calleTrabajo'    => 'yyyyy no 01',
                                           'coloniaTrabajo'  => 'hhhh',
                                           'ciudadTrabajo'   => 'Guadalajara',
                                           'cpTrabajo'       => '44444',
                                           'telefono1'       => '1111111111',
                                           'telefono2'       => '2222222222',
                                           'telefono3'       => '3333333333',
                                           'telefono4'       => '4444444444',
                                           'custom1'         => '10000',
                                           'custom2'         => 'estos',
                                           'custom3'         => 'campos',
                                           'custom4'         => 'pueden',
                                           'custom5'         => 'alojar',
                                           'custom6'         => 'otro',
                                           'custom7'         => 'tipo',
                                           'custom8'         => 'de',
                                           'custom9'         => 'informacion',
                                           'custom10'         => '&&&',
                                         ));

                                 db::table('clientesdetail')->insert(array(
                                          'customerid'     => 8,
                                          'nombreCliente'   => 'ggggggggg',
                                          'calleCasa'       => 'zzzz no 00',
                                          'coloniaCasa'     => 'aaaa',
                                          'ciudadCasa'      => 'Guadalajara',
                                          'cpCasa'          => '44444',
                                          'calleTrabajo'    => 'bbbbb no 01',
                                          'coloniaTrabajo'  => 'ccccc',
                                          'ciudadTrabajo'   => 'Guadalajara',
                                          'cpTrabajo'       => '44444',
                                          'telefono1'       => '1111111111',
                                          'telefono2'       => '2222222222',
                                          'telefono3'       => '3333333333',
                                          'telefono4'       => '4444444444',
                                          'custom1'         => '10000',
                                          'custom2'         => 'estos',
                                          'custom3'         => 'campos',
                                          'custom4'         => 'pueden',
                                          'custom5'         => 'alojar',
                                          'custom6'         => 'otro',
                                          'custom7'         => 'tipo',
                                          'custom8'         => 'de',
                                          'custom9'         => 'informacion',
                                          'custom10'         => '///',
                                      ));


                                  db::table('clientesdetail')->insert(array(
                                           'customerid'     => 9,
                                           'nombreCliente'   => 'hhhhhhhhhh',
                                           'calleCasa'       => 'ddddd no 00',
                                           'coloniaCasa'     => 'hhhhh',
                                           'ciudadCasa'      => 'Guadalajara',
                                           'cpCasa'          => '44444',
                                           'calleTrabajo'    => 'iiiii no 01',
                                           'coloniaTrabajo'  => 'jjjjj',
                                           'ciudadTrabajo'   => 'Guadalajara',
                                           'cpTrabajo'       => '44444',
                                           'telefono1'       => '1111111111',
                                           'telefono2'       => '2222222222',
                                           'telefono3'       => '3333333333',
                                           'telefono4'       => '4444444444',
                                           'custom1'         => '10000',
                                           'custom2'         => 'estos',
                                           'custom3'         => 'campos',
                                           'custom4'         => 'pueden',
                                           'custom5'         => 'alojar',
                                           'custom6'         => 'otro',
                                           'custom7'         => 'tipo',
                                           'custom8'         => 'de',
                                           'custom9'         => 'informacion',
                                           'custom10'         => '((()))',
                                       ));

                                 db::table('clientesdetail')->insert(array(
                                          'customerid'     => 10,
                                          'nombreCliente'   => 'iiiiiiiiii',
                                          'calleCasa'       => 'kkkk no 00',
                                          'coloniaCasa'     => 'llll',
                                          'ciudadCasa'      => 'Guadalajara',
                                          'cpCasa'          => 'mmmm',
                                          'calleTrabajo'    => 'nnnn no 01',
                                          'coloniaTrabajo'  => 'oooo',
                                          'ciudadTrabajo'   => 'Guadalajara',
                                          'cpTrabajo'       => '44444',
                                          'telefono1'       => '1111111111',
                                          'telefono2'       => '2222222222',
                                          'telefono3'       => '3333333333',
                                          'telefono4'       => '4444444444',
                                          'custom1'         => '10000',
                                          'custom2'         => 'estos',
                                          'custom3'         => 'campos',
                                          'custom4'         => 'pueden',
                                          'custom5'         => 'alojar',
                                          'custom6'         => 'otro',
                                          'custom7'         => 'tipo',
                                          'custom8'         => 'de',
                                          'custom9'         => 'informacion',
                                          'custom10'         => '====',
                                      ));
                                }
                              }
