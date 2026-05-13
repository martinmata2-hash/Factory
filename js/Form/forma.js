import {ValidarForm} from "./validar.js";
export class Form extends ValidarForm
{
    forma; //forma
    submit; //submit button
    url; //direccion post
    accion; //controller target
    mensaje; //On success mostrar
    redirecciona; //redirecciona
    buttonText;
    redirecciona = null;
    remote = null;
    credenciales = null;    
    

    constructor (form, submit, target, accion, mensaje,redirecciona = null, remote = null, credenciales = null)
    {
        super();
        this.forma = $(form);
        this.submit = $(submit);
        this.buttonText = this.submit.html();
        this.url = target;
        this.accion = accion;
        this.mensaje = mensaje;
        this.redirecciona = redirecciona;       
        this.remote = remote;
        this.credenciales = credenciales;        
        
        
    }

    /**
     * 
     * @param {Event} event 
     * @returns 
     */
    handleSubmit(event)
    {
        event.preventDefault();		 	  	 			
		var datos = $(this.forma).serialize();
        var formadata =
        {
            accion:this.accion,
            data:datos,
            token:$("#CSRF").val()
        };
                
        return this.postForm(formadata);
    }

    /**
     * 
     * @param {boolean} loading 
     */
    loading(loading)
    {
        if(loading)
            {                
                this.submit.prop('disabled', true);
                // add spinner to button
                this.submit.html(
                    '<i class=\"fa fa-circle-o-notch fa-spin\"></i> Trabajando...'
                );
            }
            else
            {
                // enable button
                this.submit.prop('disabled', false);               
                this.submit.html(this.buttonText);        	
            }
    }    

    /**
     * 
     * @param {Array} datos           
     */
    postForm(datos)
    {                       
        return this.ajax_call(this.url, datos, 
            this.postBegin.bind(this),
            this.postSucces.bind(this),
            this.error.bind(this),
            this.finish.bind(this)
        );

    }
    
    postBegin()
    {            
        this.loading(true);
    }

    postSucces(respuesta)
    {
        try
        {
            var datos = JSON.parse(respuesta);
            if(datos.status == 200)
            {
                $.notify(this.mensaje,"success");
                this.redirecciona(datos.request)                    
                this.loading(false);
            }
            else
            {                
                if (typeof datos.message === 'object') 
                {
                    $.each(datos.message, function(i, value) 
                    {
                        $("#" + i).notify(value, 'warning');
                        $("#" + i).addClass("error");
                    });					
                }
                else 
                {					
                    $(this.submit).notify(datos.message, 'warning');
                }
                this.loading(false);
            }
        }
        catch(e)
        {            
            this.loading(false);
        }
    }

    error(error)
    {        
        this.loading(false);
        $(this.submit).notify(error,"warning");
    }

    finish()
    {        
        this.loading(false);
        if(this.remote !== null)
            this.Sinc.bajaActualizacionies();
    }            
}