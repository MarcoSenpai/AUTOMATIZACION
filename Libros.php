<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Libro;
class Libros extends Controller{
    
    public function index(){
        $libro=new Libro(); //Libro() es la clase que importamos del modelo Libro.php
        //$datos['libros'] importa los datos :: El find All busca todos los registros y los obtiene
        $datos['libros']=$libro->orderBy('id','ASC')->findAll();

        $datos['cabecera']=view('template/cabecera');//Se incluye la vista cabecera
        $datos['pie']=view('template/piepagina');//Se incluye el pie de pagina

        return view('libros/listar',$datos);//$datos son los registros de la tabla libros
    }

    public function crear(){
        $datos['cabecera']=view('template/cabecera');//Se incluye la vista cabecera
        $datos['pie']=view('template/piepagina');//Se incluye el pie de pagina
        return view('libros/crear',$datos);
    }

    public function guardar(){
        $libro=new Libro();//Referenciar hacia el modelo libro
        /*$nombre=$this->request->getVar('nombre'); //imprimir el valor que se imprima a traves de nombre*/
        
        $validacion=$this->validate([
            'nombre'=>'required|min_length[3]',//se valida el nombre requerido y minimo de 3 caracteres
            'imagen'=>[
                'uploaded[imagen]', //Se valida que la imagen este cargada
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',//Se valida que tenga tipo de imagen
                'max_size[imagen,1024]',//Tamaño maximo de 1024 
                    ]
        ]);

        if (!$validacion){
            $session=session();//Variable de sesion
            $session->setFlashdata('mensaje','Revise la información ingresada');
            return redirect()->back()->withInput();//Retornar hacia atras enviando valores
            //return $this->response->redirect(site_url('/listar'));
        }

        if($imagen=$this->request->getFile('imagen')){
            $nuevoNombre=$imagen->getRandomName();//Para que no se repitan nombres
            //se copia la imagen, el punto suspensivo es para regresar(salir de la carpeta controllers), si no existe la carpeta se crea, 
            $imagen->move('../public/uploads/',$nuevoNombre);
            $datos=[
                'nombre'=>$this->request->getVar('nombre'),
                'imagen'=>$nuevoNombre
            ];
            $libro->insert($datos);
        }
        return $this->response->redirect(site_url('/listar'));
    }  
    
    public function borrar($id=null){
        $libro= new Libro();
        
        //datos libro cuando el 'id' conincida con el $id y muestra el primer elemento
        $datosLibro=$libro->where('id',$id)->first();  
        
        $ruta=('../public/uploads/'.$datosLibro['imagen']);
        unlink($ruta); //Borra el archivo con el unlink utilizando la $ruta

        //Eliminar registro con el id que coincida con $id
        $libro->where('id',$id)->delete($id); 

        return $this->response->redirect(site_url('/listar'));
    }

    public function editar($id=null){
     
        $libro=new Libro(); //Crear un nuevo modelo

        //Consultar los libros que coincidan con el ID y agarrar uno para editar la info
        $datos['libro']=$libro->where('id',$id)->first(); 

        //Incluir la cabecera y pie 
        $datos['cabecera']=view('template/cabecera');
        $datos['pie']=view('template/piepagina');
        
        return view('libros/editar',$datos);
    }

    public function actualizar(){
        $libro=new Libro();
        $datos=[
            'nombre'=>$this->request->getVar('nombre'),
        ];
        //Se recepciona de 'editar' el valor id que se envia
        $id=$this->request->getVar('id');

        $validacion=$this->validate([
            'nombre'=>'required|min_length[3]',//se valida el nombre requerido y minimo de 3 caracteres
            ]);

        if (!$validacion){
            $session=session();//Variable de sesion
            $session->setFlashdata('mensaje','Revise la información ingresada');
            return redirect()->back()->withInput();//Retornar hacia atras enviando valores
        }


        $libro->update($id,$datos);
        
        //VALIDACION DE LA IMAGEN
        $validacion=$this->validate([
            'imagen'=>[
                'uploaded[imagen]', //Se valida que la imagen este cargada
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',//Se valida que tenga tipo de imagen
                'max_size[imagen,1024]',//Tamaño maximo de 1024 
            ]
        ]);

        if($validacion){
            if($imagen=$this->request->getFile('imagen')){
                $datosLibro=$libro->where('id',$id)->first(); //Recuperar informacion
                $ruta=('../public/uploads/'.$datosLibro['imagen']); //Armar ruta de la imagen
                unlink($ruta); //Borrado de imagen antigua
                //Actualización con la imagenn
                $nuevoNombre=$imagen->getRandomName();
                $imagen->move('../public/uploads/',$nuevoNombre);
                $datos=['imagen'=>$nuevoNombre];
                $libro->update($id,$datos);
            }
        }
        return $this->response->redirect(site_url('/listar'));
    }
}