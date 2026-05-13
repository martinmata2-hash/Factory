function filler(json_datos, modelo = "cliente", )
{    
    var estado;
    var colonia;
    var municipio;
    var regimen;
    var uno = false;
    var dos = false;
    var tres = false;
    var finish = false;

    var conteio = 0;
    if(modelo == "cliente")
    {
        $(document).ajaxComplete(function()
        {
        
            if(!uno)
            {        	
                $.each(json_datos, function (i,value)
                {
                    try
                    {	   	                  			     							
                        $('#'+i).val(value);    
                        if(i == "CliEstado")           
                        {
                            //$("#CliEstado").change();                                 
                            estado = value;                    
                        }
                        else if(i == "CliCp")            	 	        	 
                            $("#CliCp").change();            	 		
                        else if(i == "CliColonia")
                            colonia = value;           
                        else if(i == "CliMunicipio")
                            municipio = value;
                        else if(i == "CliRegimen")                        
                            regimen = value;                                                    
                    }
                    catch (e){}
                });                                
                uno = true;                
            }
            else if(!dos)
            {                                                                    
                $("#CliRegimen").val(regimen);                                
                dos = true;                
            }   
            else if(!tres)
            {                
                $("#CliMunicipio").val(municipio);	  
                $("#CliColonia").val(colonia);
                tres = true;                
            }         
            else
            {
                if(!finish)
                    {
                                                   
                            $("#CliColonia").val(colonia);                                 
                            if(conteio == 6) 
                                finish = true;                                                 
                    }          
            }            
            conteio++;            
        });
        
    }
    else if(modelo == "producto")
    {
        $.each(json_datos, function (i,value)
        {
            try
            {
                $('#'+i).val(value); 
                if(i == "ProPaquete" || i == "ProAntibiotico")
                {	                
                    if(value == '1')						
                    {
                        $('#'+i).prop("checked", true);
                        $("input[name='"+i+"']").val(1);
                    }
                }	

            }
            catch(e){console.log(e);}
        });
    }

    else if(modelo == "proveedor")
    {
        $(document).ajaxComplete(function()
        {
        
            if(!uno)
            {        	
                $.each(json_datos, function (i,value)
                {
                    try
                    {	   	                  			     							
                        $('#'+i).val(value);    
                        if(i == "ProvEstado")           
                        {
                            $("#CliEstado").val(value);                                 
                            estado = value;                    
                        }
                        else if(i == "ProvCp")            	 	        	 
                        {
                            $("#CliCp").val(value);
                            $("#CliCp").change();            	 		
                        }
                        else if(i == "ProvColonia")
                            colonia = value;           
                        else if(i == "ProvMunicipio")
                        {
                            municipio = value;
                            $("#CliMunicipio").val(value);
                        }
                        else if(i == "ProvRegimen")                        
                        {
                            $("#ProvRegimen").val(value);
                            regimen = value;                                                    
                        }
                    }
                    catch (e){}
                });                                
                uno = true;                
            }
            else if(!dos)
            {                                                                    
                $("#ProvRegimen").val(regimen);                                
                dos = true;                
            }   
            else if(!tres)
            {                
                $("#CliMunicipio").val(municipio);	  
                $("#CliColonia").val(colonia);
                tres = true;                
            }         
            else
            {
                if(!finish)
                {
                                           
                        $("#CliColonia").val(colonia);                        
                        if(conteio == 6) 
                            finish = true;                                             
                }                
            }            
            conteio++;            
        });
    }
    else if(modelo == "compra" || modelo == "venta")
    {
        $.each(json_datos, function (i,value)
        {                
            try
            {	   	                  			     							
                $('#'+i).val(value); 
                if(i == 'FacDescuento')
                {
                    $('#descuento').val(value);
                }
                    
            }
            catch(e){}
        });        
    }
    else if(modelo == "servicio")
    {
        $.each(json_datos, function (i,value)
        {                
            try
            {	   	                  	
                if(i == "SerVehiculo")
                    vehiculo = value;		   
                if(i == "SerEntrada" || i == "SerSalida")  			
                    value = value.slice(0,-3);
                $('#'+i).val(value);                 
                    
            }
            catch(e){}
        });        
        $("#SerCliente").change();        
    }
    else if(modelo == "propio")
    {
        $.each(json_datos, function (i,value)
        {                
            try
            {	   	                  			     							
                $('#'+i).val(value);                     
                if(i == "ProCp")
                {
                    $("#CliCp").val(value);
                    $("#CliCp").change();
                }
            }
            catch(e){}
        });
    }
    else
    {                
        
        $.each(json_datos, function (i,value)
        {                
            try
            {	   	                  			     							
                $('#'+i).val(value);                     
            }
            catch(e){}
        });
    }                       

}