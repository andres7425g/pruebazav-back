<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MyModel extends CI_Model
{
    //Headres de autenticacion
    var $client_service = "frontend-client";
    var $auth_key       = "testapi";

    /*
    Metodo de hacer 'check' al usuario que esta cargando los servicios
    mediante los headres
    */
    public function check_auth_client()
    {
        $client_service = $this->input->get_request_header('Client-Service', TRUE);
        $auth_key  = $this->input->get_request_header('Auth-Key', TRUE);
        if ($client_service == $this->client_service && $auth_key == $this->auth_key) {
            return true;
        } else {
            return json_output(401, array('status' => 401, 'message' => 'Unauthorized.'));
        }
    }
    //Funcion de logueo
    public function login($username, $password)
    {
        $q  = $this->db->select('password,id')->from('users')->where('username', $username)->get()->row();
        if ($q == "") {
                return array('status' => 204, 'message' => 'Username not found.');
        } else {
            $hashed_password = $q->password;
            $id              = $q->id;
            if (hash_equals($hashed_password, crypt($password, $hashed_password))) {
                $last_login = date('Y-m-d H:i:s');
                $token = $hashed_password;
                $this->db->trans_start();
                $this->db->where('id', $id)->update('users', array('last_login' => $last_login));
                $this->db->insert('users_authentication', array('users_id' => $id, 'token' => $token));
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    return array('status' => 500, 'message' => 'Internal server error.');
                } else {
                    $this->db->trans_commit();
                    return array('status' => 200, 'message' => 'Successfully login.', 'id' => $id, 'token' => $token);
                }
            } else {
                return array('status' => 204, 'message' => 'Wrong password.');
            }
        }
    }
    //Funcion de deslogueo
    public function logout()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $this->db->where('users_id', $users_id)->where('token', $token)->delete('users_authentication');
        return array('status' => 200, 'message' => 'Successfully logout.');
    }
    //Funcion de autenticacion
    public function auth()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $q  = $this->db->select('users_id')->from('users_authentication')->where('users_id', $users_id)->where('token', $token)->get()->row();
        if ($q == "") {
            return json_output(401, array('status' => 401, 'message' => 'Unauthorized.'));
        } else {
            $updated_at = date('Y-m-d H:i:s');
            $this->db->where('users_id', $users_id)->where('token', $token)->update('users_authentication', array('updated_at' => $updated_at));
            return array('status' => 200, 'message' => 'Authorized.');
        }
    }
    //Funcion de ver todos los datos de la tabla visitas
    public function visit_all_data()
    {
        return $this->db->select('nombre,correo,motivo_visita')->from('visitas')->order_by('id', 'desc')->get()->result();
    }
    //Funcion de ver todos los datos de la tabla visitas de un dato definido por su id
    public function visit_detail_data($id)
    {
        return $this->db->select('id,nombre,correo,motivo_visita, comentario')->from('visitas')->where('id', $id)->order_by('id', 'desc')->get()->row();
    }
    //Funcion de crear visita
    public function visit_create_data($data)
    {
        $this->db->insert('visitas', $data);
        return array('status' => 201, 'message' => 'Data has been created.');
    }
    //Funcion de actualizar visita
    public function visit_update_data($id, $data)
    {
        $this->db->where('id', $id)->update('visitas', $data);
        return array('status' => 200, 'message' => 'Data has been updated.');
    }
    //Funcion de eliminar visita
    public function visit_delete_data($id)
    {
        $this->db->where('id', $id)->delete('visitas');
        return array('status' => 200, 'message' => 'Data has been deleted.');
    }
}
