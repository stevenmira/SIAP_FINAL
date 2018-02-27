<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-verificar">

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" 
            aria-label="Close">
                 <span aria-hidden="true">×</span>
            </button>
            <h2 class="modal-title"><i class="fa fa-info-circle"></i> Verifique los siguientes datos </h2 >
   
            <ul class="list-group">
                <li class="list-group-item">Cliente</li>
                <li class="list-group-item">Negocio</li>
                <li class="list-group-item">Tipo de credito</li>
                <li class="list-group-item">Monto a otorgar</li>
                <li class="list-group-item">Cuota del cliente</li>
            </ul>
        <blockquote>
            Asegurece que los campos antes mencionados esten correctos.
            Para verificarlo puede dar clic en el boton <strong>Atras</strong> .

            <p>Si los campos son correctos puede dar clic en <strong>Guardar</strong>  para continuar.</p>
        </blockquote>
           
        <div class="row">
        <div class="form-group">
        <div class="modal-footer">
                <input name="_token" value="{{csrf_token()}}" type="hidden"></input> 
                <a data-dismiss="modal" class="btn btn-danger btn-lg col-md-offset-2">Atras</a>
                <button class="btn btn-primary btn-lg col-md-offset-8" type="submit">Guardar</button> 
        </div>
        </div>
        </div>

    </div>
</div>


