
import {Post} from "./post.js";

export class Unico extends Post
{    
    constructor()
    {
        super();          
    }
     
    /**
     * 
     * @param {string} tipo 
     * @param {string} valor 
     * @param {string} campo 
     * @param {HTMLInputElement} objecto 
     * @returns 
     */
     handleValidation(tipo, valor, campo, objecto)
     {                 
        return this.validar(tipo, valor, campo, $(objecto));                  
     }             
    
    /**
     * 
     * @param {string} tipo 
     * @param {string} valor 
     * @param {string} campo 
     * @param {HTMLInputElement} objeto
     * @returns 
     */
     
    validar(tipo, valor, campo, objeto)
    {       
        
        return this.ajax_call("/Dashboard/Ajax/Validar/Unico.php",
            {
                validar:"unico",
                tipo:tipo, 
                value:valor,
                campo:campo
            },
            function(){},            
            succed, 
            error,
            finish,
            false
        );
        
        /**
         * 
         * @param {string} respuesta 
         */
        function succed(respuesta)
        {            
            const datos = JSON.parse(respuesta);
            if(datos.status == 200)
            {
                validData();
            }
            else 
            {
                invalidData();                
                $(objeto).notify(datos.message, "error");
            }

        }

        function error(error)
        {
            invalidData();
            console.log(error);
        }

         /**
         * AL final de la validacion
         * @param {string} respuesta 
         */
         function finish(respuesta)
         {
             ;
         }      
        
        function validData()
        {
            $(objeto).removeClass(classInvalid);
            $(objeto).addClass(classValid);
        }

        function invalidData()
        {
            $(objeto).removeClass(classValid);
            $(objeto).addClass(classInvalid);			
        }
          
         
    }
   
}