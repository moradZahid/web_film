<?php

class UserDao extends Dao
{
    public function getAll()
    {
        try
        {
            $str_query = 'SELECT * FROM user';
            $query = $this->_bdd->query($str_query);
            $data = $query->fetchAll();
            
            if (count($data) == 0)
            {
                throw New Exception();
            }
        }
        catch(Exception $e)
        {
            $url = './?action=erreur&msg=';
            $url .= urlencode("Erreur de la base de donnee.");
            header('Location:'.$url);
        }
        

        return $data;
    }

    public function getOne($id)
    {
        echo 'ok';
    }
     
    public function add($user)
    {
        try
        {
            $str_prep = 'INSERT INTO user(userName, email, password) 
                         VALUES (:userName, :email, :password)';
            $prep = $this->_bdd->prepare($str_prep);
            $status = $prep->execute([
                'userName' => $user->getUserName(),
                'email' => $user->getEmail(),
                'password' => password_hash($user->getPassword(),PASSWORD_DEFAULT)
            ]);
            if (!$status)
            {
                throw New Exception();
            }
            $_SESSION['msg'] = 'Utilisateur ajouté.';
        }
        catch(Exception $e)
        {
            $url = './?action=erreur&msg=';
            $url .= urlencode("Erreur de la base de donnee.");
            header('Location:'.$url);
        }
    }

    public function modifyUser($user)
    {
        try
        {
            $str_prep = 'UPDATE user
                         SET userName=:userName, email=:email
                         WHERE idUser=:idUser';
            $prep = $this->_bdd->prepare($str_prep);
            $status = $prep->execute([
                'userName' => $user->getUserName(),
                'email' => $user->getEmail(),
                'idUser' => $user->getIdUser()
            ]);
            if (!$status)
            {
                throw New Exception();
            }
            $_SESSION['msg'] = 'Utilisateur modifié.';
        }
        catch(Exception $e)
        {
            $url = './?action=erreur&msg=';
            $url .= urlencode("Erreur de la base de donnee.");
            header('Location:'.$url);
        }
    }

    public function modifyPassword($user)
    {
        try
        {
            $str_prep = 'UPDATE user
                         SET password=:password
                         WHERE idUser=:idUser';
            $prep = $this->_bdd->prepare($str_prep);
            $status = $prep->execute([
                'password' => password_hash($user->getPassword(),PASSWORD_DEFAULT),
                'idUser' => $user->getIdUser()
            ]);
            if (!$status)
            {
                throw New Exception();
            }
            $_SESSION['msg'] = 'Mot de passe modifié.';
        }
        catch(Exception $e)
        {
            $url = './?action=erreur&msg=';
            $url .= urlencode("Erreur de la base de donnee.");
            header('Location:'.$url);
        }
    }

    public function deleteUser($idUser)
    {
        try
        {
            $str_prep = 'DELETE FROM user
                         WHERE idUser=:idUser';
            $prep = $this->_bdd->prepare($str_prep);
            $status = $prep->execute([
                'idUser' => $idUser
            ]);
            if (!$status)
            {
                throw New Exception();
            }
            $_SESSION['msg'] = 'Utilisateur supprimé.';
        }
        catch(Exception $e)
        {
            $url = './?action=erreur&msg=';
            $url .= urlencode("Erreur de la base de donnee.");
            header('Location:'.$url);
        }
    }
}