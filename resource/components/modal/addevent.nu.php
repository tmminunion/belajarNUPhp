 <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Create New Donation Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-type" method="POST">
                        <div class="form-group">
                            <label for="eventName">Event Name</label>
                            <input type="text" class="form-control" id="eventName" placeholder="Enter event name">
                        </div>
                        <div class="form-group">
                            <label for="eventId">Event ID</label>
                            <input type="text" class="form-control" id="eventId" placeholder="Enter event ID">
                        </div>
                        <div class="form-group">
                            <label for="eventSlot">Event Slot</label>
                            <input type="number" class="form-control" id="eventSlot" placeholder="Enter event slot">
                        </div>
                        <div class="form-group">
                            <label for="eventCapacity">Event Capacity</label>
                            <input type="number" class="form-control" id="eventCapacity" placeholder="Enter event capacity">
                        </div>
                        <button type="submit" class="btn btn-primary">Create Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>