<?php

class RolesDAO extends Dao
{

    //Récupérer tout les roles
    public function getAll()
    {

        $query = $this->_bdd->prepare("SELECT idActeur, idFilm, personnage, idRole FROM role");
        $query->execute();
        $roles = array();


        while ($data = $query->fetch()) {
            $roles[] = new Role($data['personnage'], $data['idRole'], $data['idFilm'], null, null, $data['idActeur']);
        }
        return ($roles);
    }



    //Ajouter un role
    public function add($data)
    {

        $valeurs = [
            'personnage' => $data->get_personnage(),
            'idFilm' => $data->get_idFilm(),
            'idActeur' => $data->get_idActeur()
        ];

        $requete = 'INSERT INTO role (personnage, idFilm, idActeur, test) VALUES (:personnage, :idFilm, :idActeur, 0)';
        $insert = $this->_bdd->prepare($requete);
        if (!$insert->execute($valeurs)) {
            return false;
        } else {
            return true;
        }
    }

    //Récupérer plus d'info sur un role
    public function getOne($idRole)
    {

        $query = $this->_bdd->prepare('SELECT * FROM role WHERE role.idRole = :idRole')->fetch(PDO::FETCH_ASSOC);
        $query->execute(array(':idRole' => $idRole));
        $data = $query->fetch();
        $role = new Role($data['idRole'], $data['personnage']);
        return ($role);
    }

    //Supprimer un role
    public function deleteOne($idRole): int
    {
        $query = $this->_bdd->prepare('DELETE FROM role WHERE role.idRole = :idRole');
        $query->execute(array(':idRole' => $idRole));
        return ($query->rowCount());
    }

    //Modifier un role
    public function modifyRole($role)
    {
        $query = $this->_bdd->prepare('UPDATE role
        SET idActeur= :idActeur, idFilm= :idFilm, personnage= :personnage
        WHERE idRole = :idRole');
        $query->execute(array(
            'idActeur' => $role->get_idActeur(),
            'idFilm' => $role->get_idFilm(),
            'personnage' => $role->get_personnage(),
            'idRole' => $role->get_idRole()
        ));

        return ($query->rowCount());
    }

    public function alterTable()
    {
        $str_query = 'ALTER TABLE role
                      DROP CONSTRAINT fk_acteur';
        $query = $this->_bdd->query($str_query);

        $str_query = 'ALTER TABLE role
                      DROP CONSTRAINT fk_film';
        $query = $this->_bdd->query($str_query);

        $str_query = 'ALTER TABLE `role`
                      ADD CONSTRAINT `fk_acteur` 
                      FOREIGN KEY (`idActeur`) 
                      REFERENCES `acteurs` (`idActeur`) 
                      ON DELETE CASCADE 
                      ON UPDATE CASCADE,
                      ADD CONSTRAINT `fk_film` 
                      FOREIGN KEY (`idFilm`) 
                      REFERENCES `films` (`idFilm`)
                      ON DELETE CASCADE 
                      ON UPDATE CASCADE';
        $query = $this->_bdd->query($str_query);
    }
}
