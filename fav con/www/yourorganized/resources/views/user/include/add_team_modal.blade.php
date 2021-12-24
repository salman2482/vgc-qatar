<div style="padding-top: 100px" class="modal fade" id="new_team" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      
        <form method="post" action="{{url('addTeam')}}">
         <!-- Modal body -->
      <div class="modal-body">
      <div id="new_drill" class="modal-body">  
          <label>Team Name</label>  
          <input required name="team_name" type="text" class="form-control" id="" placeholder="Team Name"> 
      </div>
      </div>
         
      
             @csrf
      <div class="modal-footer">
       
        <button data-id="" type="submit" class="btn btn-success ">Add</button>
         <button  type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
         </form>
    </div>
  </div>
</div>