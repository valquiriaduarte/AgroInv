<?php
    class CaixaProf{
        public function criaCaixaProf(){
          $con = new mysqli('localhost', 'root', '', 'db');
          $sql = $con -> query("SELECT nome, email, img FROM usuarios WHERE tipo LIKE \"professor\"");

          while($col = $sql -> fetch_assoc()){
            echo "<li>";
            echo "<img id=\"profpic\" src=" . $col["img"] . ">";
            echo "<p>";
            echo $col["nome"] . "<br>";
            echo $col["email"];
            echo "</p>";
            echo "</li>";      
          }
        }
    }
?>