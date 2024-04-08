@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="fs-20 fw-700 text-dark">{{ translate('Support Ticket') }}</h1>
            </div>
        </div>
    </div>
    
    <!-- Create a Ticket -->
    <div class="p-4 mb-3 c-pointer text-center bg-light has-transition border h-100 hov-bg-soft-light" data-toggle="modal" data-target="#ticket_modal">
        <i class="las la-plus la-3x mb-2"></i>
        <div class="fs-14 fw-600 text-dark">{{ translate('Create a Ticket') }}</div>
    </div>

    <!-- Tickets -->
    <div class="card rounded-0 shadow-none border">
        <div class="card-header border-bottom-0">
            <h5 class="mb-0 fs-20 fw-700 text-dark text-center text-md-left">{{ translate('Tickets')}}</h5>
        </div>
          <div class="card-body py-0">
              <table class="table aiz-table mb-4">
                  <thead class="text-gray fs-12">
                      <tr>
                          <th data-breakpoints="lg" class="pl-0">{{ translate('Ticket ID') }}</th>
                          <th data-breakpoints="lg">{{ translate('Sending Date') }}</th>
                          <th>{{ translate('Subject')}}</th>
                          <th>{{ translate('Status')}}</th>
                          <th data-breakpoints="lg" class="text-right pr-0">{{ translate('Options')}}</th>
                      </tr>
                  </thead>
                  <tbody class="fs-14">
                      @foreach ($tickets as $key => $ticket)
                          <tr>
                              <td class="pl-0 fw-700">#{{ $ticket->code }}</td>
                              <td>{{ date('Y.m.d h:i:m', strtotime($ticket->created_at)) }}</td>
                              <td>{{ $ticket->subject }}</td>
                              <td>
                                  @if ($ticket->status == 'pending')
                                      <span class="badge badge-inline badge-danger p-3 fs-12" style="border-radius: 25px; min-width: 80px !important;">{{ translate('Pending')}}</span>
                                  @elseif ($ticket->status == 'open')
                                      <span class="badge badge-inline badge-secondary p-3 fs-12" style="border-radius: 25px; min-width: 80px !important;">{{ translate('Open')}}</span>
                                  @else
                                      <span class="badge badge-inline badge-success p-3 fs-12" style="border-radius: 25px; min-width: 80px !important;">{{ translate('Solved')}}</span>
                                  @endif
                              </td>
                              <td class="text-right pr-0">
                                  <a href="{{route('support_ticket.show', encrypt($ticket->id))}}" class="btn btn-styled btn-link fw-700 py-1 px-0 icon-anim text-decoration-none">
                                      {{ translate('View Details')}}
                                      <i class="la la-angle-right fw-900 text-sm"></i>
                                  </a>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
              <!-- Pagination -->
              <div class="aiz-pagination">
                  {{ $tickets->links() }}
              </div>
          </div>
    </div>
@endsection

@section('modal')
    <!-- Ticket modal -->
    <div class="modal fade" id="ticket_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{ translate('Create a Ticket')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-3 pt-3">
                    <form class="" action="{{ route('support_ticket.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Subject')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3 rounded-0" placeholder="{{ translate('Subject')}}" name="subject" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Provide a detailed description')}}</label>
                            </div>
                            <div class="col-md-10">
                                <textarea type="text" class="form-control mb-3 rounded-0" rows="3" name="details" placeholder="{{ translate('Type your reply')}}" data-buttons="bold,underline,italic,|,ul,ol,|,paragraph,|,undo,redo" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{ translate('Photo') }}</label>
                            <div class="col-md-10">
                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium rounded-0">{{ translate('Browse')}}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="attachments" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                        <div class="text-right mt-4">
                            <button type="button" class="btn btn-secondary rounded-0 w-150px" data-dismiss="modal">{{ translate('cancel')}}</button>
                            <button type="submit" class="btn btn-primary rounded-0 w-150px">{{ translate('Send Ticket')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
