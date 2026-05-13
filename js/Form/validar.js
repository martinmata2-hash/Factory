
import {Post} from "./post.js";
import {Unico} from "./unico.js";


export class ValidarForm extends Post
{
    objeto; //htmlobjeto
    success = 200;
    unico = false;
    tipo = "";
    valor = null; //valor unico
    campo = null; //campo unico        
    continua = false;
    valido = false;
    
    constructor()
    {
        super();          
    }
     /**
     * Punto inicial de la validacion
     * @param {HTMLInputElement|HTMLSelectElement} objeto 
     */
     handleValidation(objeto)
     {         
        this.objeto = objeto;
         this.success = 200;
         this.unico = $(objeto).data("unico") == true;
         this.tipo = $(objeto).data("type");
         this.datos = $(objeto).data("validar");
         this.valido = false;
         this.continua = true;
         //this.valor = valor;
         //this.campo = campo;
         if(this.tipo == "length" || $(objeto).data("length"))
             this.validaLength();
         else if(this.tipo == "condicion")
             this.validaCondicion();
         else if(this.continua)
         {
             var form_data = 
             {
                 validar:$(this.objeto).data("type"),
                 value:$(this.objeto).val()
             }
             //form_data, objeto, this.success, unico = false, tipo = "", valor = null, campo = null
           return this.validar(form_data,this.objeto,this.success,this.unico,this.tipo,$(this.objeto).val(),$(this.objeto).attr("id"),this.datos);
         }
         return true;
 
     }

     /**
      * Los datos osn validos
      */
    validData()
    {
        $(this.objeto).removeClass(classInvalid);
        $(this.objeto).addClass(classValid);
    }

    /**
     * Los datos son invalidos
     */
    invalidData()
    {
        $(this.objeto).removeClass(classValid);
        $(this.objeto).addClass(classInvalid);			
    }
    
    /**
     * Validar la longitud del input
     */
    validaLength()
    {        
        this.continua = false;
        if(this.validaLength2($(this.objeto).val(), Number($(this.objeto).data("length"))))
            this.validData();
        else this.invalidData();
    }

    /**
     * Validad la longitud
     * @param {string} value 
     * @param {Number} length 
     * @returns 
     */
    validaLength2(value, length)
    {        
        return String(value).length >= length;
    }

    /**
     * Validar condiciones o restringciones del input
     */
    validaCondicion()
    {
        this.valido= false;
        this.continua = false;
        var conditionValue = $(this.objeto);
        var parte = $(this.objeto).data("condicion").split("|");
        var condicionId = parte[0];
        var partes = parte[1].split(";");
        $(partes).each(function(i,value)
        {
           var condicion = value.split("+"); 
           if(condicion.length > 1 && !valid)
           {
                if($("#"+condicionId).val() == condicion[0] && $(conditionValue).val() == condicion[1])
                {
                    this.valido= true;
                    this.validData();
                }
                else
                {
                    this.valido= false;
                    this.invalidData();
                }
           }

           condicion = value.split("-");
           if(condicion.length > 1 && !valid)
           {
            if($("#"+condicionId).val() == condicion[0])
            {
                this.valido= false;
                this.invalidData();
            }
            else if($("#"+condicionId).val() == condicion[0] && $(conditionValue).val() == condicion[1])
            {
                this.valido= false;
                this.invalidData();
            }
            else
            {
                this.valido= true;
                this.validData();
            }
           }
        });
    }

    /**
     * validar campos unicos en base de datos
     * @param {Array} form_data 
     * @param {HTMLElement} objeto 
     * @param {Number} success 
     * @param {boolean} unico 
     * @param {string} tipo 
     * @param {string} valor 
     * @param {string} campo 
     */
    validar(form_data, objeto, success, unico = false, tipo = "", valor = null, campo = null, modelo = null)
    {       
        
        return this.ajax_call("/Dashboard/Ajax/Validar/",form_data,
            function(){},            
            exito, 
            error,
            terminamos,
            false
        );
        
        function exito(respuesta)
        {
            const datos = JSON.parse(respuesta);                        
            if(datos.status == 200)
            {
                if(unico)
                {        
                    var verificaUnico = new Unico();
                    return verificaUnico.handleValidation(modelo, valor, campo, objeto);                    
                }
                else validData();
                    
            }
            else
            {
                invalidData();                
                $(objeto).notify(datos.message, "error");
            }
        }

            function error(error)
            {
                validData();
                console.log(error);
            }
        
            function invalidData()
            {
                $(objeto).removeClass(classValid);
                $(objeto).addClass(classInvalid);			
            }

            function validData()
            {
                $(objeto).removeClass(classInvalid);
                $(objeto).addClass(classValid);
            }

            /**
             * AL final de la validacion
             * @param {*} respuesta 
             */
            function terminamos(respuesta)
            {
                ;
            }        
    }
   
}