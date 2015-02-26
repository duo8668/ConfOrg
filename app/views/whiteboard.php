 <table class="table table-striped">   
                <thead>
                    <tr class="filters">
                        <th style="width: 7%;"><input type="text" class="form-control" placeholder="Invoice #" disabled></th>
                        <th style="width: 20%;"><input type="text" class="form-control" placeholder="Conference" disabled></th>
                        <th style="width: 8%;"><input type="text" class="form-control" placeholder="Quantity" disabled></th>
                        <th style="width: 10%;"><input type="text" class="form-control" placeholder="Total" disabled></th>
                        <th style="width: 15%"><input type="text" class="form-control" placeholder="Status" disabled></th>
                        <th style="width: 25%;">Option</th>
                    </tr>
                </thead> 
                
                @foreach ($data as $invoice)
                <tr>            
                    <td>#{{ $invoice->invoice_id }}</td>                        
                    <!-- add a link to the conference -->
                    <td>{{ $invoice->conference->title }}</td>
                    <td>{{ $invoice->quantity }}</td>
                    <td>${{ $invoice->total }}</td>
                    <td>{{ $invoice->status }}</td>
                    <!-- we will also add show, edit, and delete buttons -->
                    <td>
                        <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                        <a class="btn btn-xs btn-info" href="{{ URL::to('invoice/' . $invoice->invoice_id) }}">Show Invoice</a>               
                </tr>
                @endforeach
                </table> 