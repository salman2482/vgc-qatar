
	
		
								<form  method="post" action="{{ url($admin_url.'add-faq') }}" autocomplete="off">
                                                                    
                                                                    <label> Select Faq Category</label><br>
                                                                    <select name="category_id" required>
                                                                        @foreach($categories as $category)
                                                                        
                                                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                                                        
                                                                        @endforeach
                                                                    </select>
                                                                    <br> <label> Enter Question</label><br>
										 <input   required  type="text" name="question"   />
										
									
                                                                       <br> <label> Enter Answer</label><br>
                                                                        
                                                                        
                                                                        <textarea name="answer" rows='4' cols="10"></textarea>
										
									
                                                                        <br>
                                                                        
                                                                          
										
                                                                        @csrf
									
                                                                            <button  type="submit">Submit</button>
									
									
				
                                                                        <form>