@extends('fonts.layouts.user')
@section('site')
    | Pago en efectivo
@endsection
@section('main-content')
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box dark">
						<div class="portlet-title">
							<div class="caption uppercase bold"><i class="fa fa-plus"></i> Pago en efectivo</div>
						</div>
						<div class="portlet-body bitcoin">
							<div class="row">

								<div class="col-md-12 text-center">
									<h3>
									{{ $efectivo['value1']}}
									</h3>
									<br>
									<br>
									<h3 style="color: red;">** Te avisaremos por email cuando se valide el depósito</h3>
									<br>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>

		</div>
	</div>
@endsection

