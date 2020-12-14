<?php
// incluye la clase Db
require_once('Conexion.php');
	
        class CrudLibro{
		// constructor de la clase
		public function __construct(){}

		// método para insertar, recibe como parámetro un objeto de tipo libro
		public function insertar($libro){
			
			$conexion = Conexion::getInstance();
			//las ? son parametros a los cuales tengo que dar valor
			$sql="INSERT INTO libros values(NULL,?,?,?)";
			//1 parte preparar la sentencia
			$insert=$conexion->prepare($sql);
			//2 parte ejecutar y pasar los valores a los paremetros ? mediante un array
			$insert->execute(array($libro->getNombre(),$libro->getAutor(),$libro->getAnio_edicion()));

		}

		// método para mostrar todos los libros
		public function mostrar(){
			 $conexion = Conexion::getInstance();
			$listaLibros=[];
			$select=$conexion->prepare('SELECT * FROM libros');
			
			$select->execute();
			
			foreach($select->fetchAll() as $libro){
				$myLibro= new Libro();
				$myLibro->setId($libro['id']);
				$myLibro->setNombre($libro['nombre']);
				$myLibro->setAutor($libro['autor']);
				$myLibro->setAnio_edicion($libro['anio_edicion']);
				$listaLibros[]=$myLibro;
			}
			return $listaLibros;
		}

		// método para eliminar un libro, recibe como parámetro el id del libro
		public function eliminar($id){
			 $conexion = Conexion::getInstance();
			 $sql="DELETE FROM libros WHERE id=?";
			 //preparo la sentencia
			$eliminar=$conexion->prepare($sql);
			//la ejecuto pasando los parametros que hagan falta
			$eliminar->execute(array($id));
		}

		// método para buscar un libro, recibe como parámetro el id del libro
		public function obtenerLibro($id){
			$conexion = Conexion::getInstance();
			$select=$conexion->prepare('SELECT * FROM libros WHERE ID=?');
			
			$select->execute(array($id));
			$libro=$select->fetch();
			$myLibro= new Libro();
			$myLibro->setId($libro['id']);
			$myLibro->setNombre($libro['nombre']);
			$myLibro->setAutor($libro['autor']);
			$myLibro->setAnio_edicion($libro['anio_edicion']);
			return $myLibro;
		}

		// método para actualizar un libro, recibe como parámetro el libro
		public function actualizar($libro){
			$conexion = Conexion::getInstance();
			$sql="UPDATE libros SET nombre=?, autor=?,anio_edicion=?  WHERE ID=?";
			//preparo la sentencia
			$actualizar=$conexion->prepare($sql);
			//la ejecuto dando valor a los parametros
			$actualizar->execute(array($libro->getAutor(),$libro->getAutor(),$libro->getAnio_edicion(),$libro->getId()));
		}
	}


