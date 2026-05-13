import { Post } from "../Form/post.js";

export class Request extends Post
{

    constructor()
    {
        super();
    }

    /**
     * 
     * @param {string} url 
     * @param {string} datos     
     * @param {*} callBack 
     * @param {HTMLButtonElement} boton
     * @returns 
     */
    request(url, datos, callBack, boton = null)
    {
        let button = boton;
        let buttonText = "Archivar";
        if(button !== null)
            buttonText = $(button).html();
        return this.ajax_call(url,datos,
            function()
            {
                if(button !== null)
                {
                    $(button).prop('disabled', true);                
                    $(button).html(
                        '<i class=\"fa fa-circle-o-notch fa-spin\"></i> Trabajando...'
                    );
                }
            },
            function(respuesta)
            {
                const datos = JSON.parse(respuesta);
                if (datos.status == 200)
                    callBack(datos.request);
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
                        if(boton !== null)				
                            $(boton).notify(datos.message, 'warning');
                        else 
                            $.notify(datos.message, 'warning');
                    }
                }
            },
            function(error){console.log(error);},
            function()
            {
                if(button !== null)
                {
                    $(button).prop('disabled', false);               
                    $(button).html(buttonText);     
                }
            },
            false
        )
    }

    remoteRespuesta(url, datos, credenciales, callBack)
    {
        
    }

    /**
     * 
     * @param {string} url 
     * @param {string} datos 
     * @param {HTMLSelectElement} select 
     * @returns 
     */
    fillSelect(url, datos,select)
    {
        return this.ajax_call(url,datos,
            function(){},
            function(respuesta)
            {
                const datos = JSON.parse(respuesta);                
                $(select).find('option')
                .remove()
                .end()
                .append("<option>Selecciona</option>"+datos.request);
            },
            function(error){console.log(error);},
            function(){},
            false
        )
    }    

}