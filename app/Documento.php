<?php namespace App;

use App\Expediente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Documento extends Model {
    
    
    
    protected $fillable = [
            'acronimo',
            'data',
            'expediente_id',
            'nombre'
        ];

    // Indice de acrónimos
    protected static $acronimos = [ 
                                    'IFFSO' => ['titulo'=>'Formulario de solicitud'],
                                    'IFHAG' => ['titulo'=>'Habilitación - autorización (AGC)'],
                                    'DOCBI' => ['titulo'=>'Título de propiedad / contrato alquiler / convenio de comodato '],
                                    'COMPR' => ['titulo'=>'Acreditación de cumplimiento de la programación del año anterior'],
                                    'FACTU' => ['titulo'=>'Facturas'],
                                    'COPRE' => ['titulo'=>'Presupuesto'],
                                    'PLANO' => ['titulo'=>'Plano de Obra'],
                                    'CESER' => ['titulo'=>'Nota de compensación de servicios'],
                                    'CONAD' => ['titulo'=>'Contrato'],
                                    'IFAUA' => ['titulo'=>'Nota de autorización artística (coreógrafo y músico / autorización de obra )'],
                                    'PRCIU' => ['titulo'=>'Cronograma de ejecución / Propuesta de la nueva programación teatral'],
                                    'DOCPE' => ['titulo'=>'Registro en ProTeatro'],
                                    'IFRAA' => ['titulo'=>'Registro en Asociación Argentina de Actores'],
                                    'PROYE' => ['titulo'=>'Síntesis argumental y texto de la obra'],
                                    'IFBOC' => ['titulo'=>'Bocetos de escenografía o vestuario'],
                                    'IFPIL' => ['titulo'=>'Planta de iluminación'],
                                    'IFVDI' => ['titulo'=>'Visión del director'],
                                    'IFTIN' => ['titulo'=>'Texto de investigación'],
                                    'REGLA' => ['titulo'=>'Reglamento consorcio'],
                                    'ACDEE' => ['titulo'=>'Acta designación de administrador.'],
                                    'IFCDR' => ['titulo'=>'Conformidad de representatividad'],
                                    'IFLIC' => ['titulo'=>'Listado de colaboradores'],
                                    'CONTR' => ['titulo'=>'Contrato c/ sala'],
                                    'DNI' => ['titulo'=>'DNI'],
                                    'DOCSE' => ['titulo'=>'Servicio a nombre del Responsable'],
                                    'CUIT' => ['titulo'=>'CUIT'],
                                    'ESTAT' => ['titulo'=>'Acta constitutiva/Estatuto de la entidad/Acta desig. Autoridades/Inscripcion IGJ'],
                                    'PODER' => ['titulo'=>'Poder'],
                                    'CV' => ['titulo'=>'CV'],
                                    'IFSGC' => ['titulo'=>'Formulario de solicitud Grupo de Teatro Comunitario '],
                                    'IFSGE' => ['titulo'=>'Formulario de solicitud Grupos Estables'],
                                    'PCIUD' => ['titulo'=>'Descripción general del proyecto, objetivos, fundamentación. Propuesta de contraprestación'],
                                    'PCIU2' => ['titulo'=>'Propuesta dramatúrgica y puesta en escena'],
                                    'FOTO' => ['titulo'=>'Foto'],
                                    'IFMAU' => ['titulo'=>'Material Audiovisual'],
                                    'PNASI' => ['titulo'=>'Partida de Nacimiento'],
                                    'IF' => ['titulo'=>'Informe del Proyecto'],
                                    'NOCPJ' => ['titulo'=>'Nota Dirigida al Consejo'],
                                    'IFASP' => ['titulo'=>'Formulario de Aceptacion de subsidio'],
                                    'ANEX' => ['titulo'=>'Propuesta dramatúrgica y puesta en escena'],
                                    'IFSST' => ['titulo'=>'Formulario de solicitud Salas Teatrales'],
                                    'IFSGG' => ['titulo'=>'Formulario de solicitud Grupos Eventuales'],
                                    'IFSPE' => ['titulo'=>'Formulario de solicitud Proyectos Especiales'],
                                    'CERTI' => ['titulo'=>'Constancia de CUIL/CUIT'],
                                    'CONST' => ['titulo'=>'Constancia de CUIL/CUIT'],
                                    'IFGRA' => ['titulo'=>'Contrato Sociedad de Hecho']
                                ];
    
    public function expediente(){
        return $this->belongsTo('App\Expediente', 'expediente_id');
    }
    
    public function nombre(){

        if($this->acronimo == 'ANEX' && $this->expediente->linea->fondo->codigo == 'PRT'){
            return 'Propuesta dramatúrgica y puesta en escena';
        }elseif($this->acronimo == 'ANEX' && $this->expediente->linea->fondo->codigo == 'BAM'){
            return 'Nota de compensación de servicios prestados';
        }

        return self::$acronimos[$this->acronimo]['titulo'];
    }
    
    public function viewResponse(){
        
        if($this->acronimo == ''){
            die('El documento no tiene un acrónimo cargado.');
        }
        
        // Esperamos una URL como dato
        if($this->acronimo == 'IFMAU'){
            
            header('Location: '.$this->data);
            exit;
            
        // Esperamos un base64 como dato, armamos un PDF
        }else{
            $filename = self::$acronimos[$this->acronimo]['titulo'].'.pdf';
            $decoded = base64_decode($this->data);

            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="'.$filename.'"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            echo $decoded;
            exit;
        
        }
    }
}
