
<div class="modal fade modal-slide-in-left" aria-hidde="true" role="dialog" tabindex="-1" id="modal-delete-{{$cont->id}}" >
	{{Form::Open(array('action'=>array('ColCotratohoController@destroy', $cont->id), 'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Terminar Contrato</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Desejas mesmo Terminar este Contrato?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
				<button type="submit" class="btn btn-primary">Sim</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>