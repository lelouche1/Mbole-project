<?php
class Reclamation{
    private int $id_recla;
    private string $em_user;
    private string $date;
    private string $text;

    public function __construct(string $em_user,string $text){
        $this->em_user = $em_user;
        $this->date = date('y-m-d');
        $this->text = $text;
    }



    public function get_Id() :int{
        return $this->Id_recla;
    }

    public function get_email() :string{
        return $this->em_user;
    }

    public function get_date() :string{
        return $this->date;
    }

    public function get_text() :string{
        return $this->text;
    }

    public function set_Id(int $id):void{
        $this->id_recla = $id;
    }

    public function set_email(string $email):void{
        $this->em_user = $email;
    }

    public function set_date(string $d):void{
        $this->date = $d;
    }

    public function set_text(string $t):void{
        $this->text = $t;
    }

}



class  Recla_prive extends Reclamation{

   private string $em_admin;
   
   public function __construct(string $em_user,string $text,string $em_admin){
    
    parent::__construct($em_user,$text);
    
    $this->em_admin = $em_admin;
}

   public function get_emailA() :string{
    return $this->em_admin;
}

   public function set_emailA(string $email):void{
    $this->em_admin = $email;
}
     
}


class Recla_public extends Reclamation{

   
}
?>