<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use App\Models\User;

Route::get('view/clear',function(){
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    return 'cleared';
});

Route::post('cafm/login', function(){
    return redirect()->back()->with('message','You Are Not Authorized');
});

Route::any('home', 'Home@index')->name('home');
Route::get('/', 'FrontendController@index')->name('front.index');

Route::get("/language/{locale}",function($locale){
    session()->put('locale', $locale);
    return redirect()->back();
})->name('set.locale');


//LOGIN & SIGNUP
Route::get("/login/s8kVt0YQNz", "Authenticate@logIn")->name('login');
Route::post("/login", "Authenticate@logInAction");
Route::get("/forgotpassword", "Authenticate@forgotPassword");
Route::post("/forgotpassword", "Authenticate@forgotPasswordAction");
Route::get("/signup", "Authenticate@signUp");
Route::post("/signup", "Authenticate@signUpAction");
Route::get("/resetpassword", "Authenticate@resetPassword");
Route::post("/resetpassword", "Authenticate@resetPasswordAction");

//LOGOUT
Route::any('logout', function () {
    if (auth()->user()->is_employee == 1) {
        Auth::logout();
        return redirect()->route('front.user.login');
    }
    Auth::logout();
    return redirect()->route('login');
});

//CLIENTS
Route::group(['prefix' => 'clients'], function () {
    Route::any("/search", "Clients@index");
    Route::post("/delete", "Clients@destroy")->middleware(['demoModeCheck']);
    Route::get("/change-category", "Clients@changeCategory");
    Route::post("/change-category", "Clients@changeCategoryUpdate");
    Route::get("/logo", "Clients@logo");
    Route::put("/logo", "Clients@updateLogo")->middleware(['demoModeCheck']);
     Route::delete("/attachments/{uniqueid}", "Clients@deleteAttachment");

    //dynamic load
    Route::any("/{client}/{section}", "Clients@showDynamic")
        ->where(['client' => '[0-9]+', 'section' => 'contacts|projects|files|tickets|invoices|expenses|payments|timesheets|estimates|notes']);
});
Route::any("/client/{x}/profile", "Clients@profile")->where('x', '[0-9]+');
Route::resource('clients', 'Clients');

//CONTACTS
Route::group(['prefix' => 'contacts'], function () {
    Route::any("/search", "Contacts@index");
    Route::get("/updatepreferences", "Contacts@updatePreferences");
    Route::post("/delete", "Contacts@destroy")->middleware(['demoModeCheck']);
});
Route::resource('contacts', 'Contacts');
Route::resource('users', 'Contacts');

// Employee
Route::group(['prefix' => 'employees'], function () {
    Route::any("/search", "EmployeesController@index");
    Route::get("/updatepreferences", "EmployeesController@updatePreferences");
     Route::get("/employee-schedules/{id?}", "EmployeesController@scheduleView")->name('employees.add-schedule');
    Route::get("/fetch-schedules/{id}", "EmployeesController@fetchSchedules")->name('employees.fetch-schedule');
    Route::post("/employee-schedules/", "EmployeesController@storeSchedule")->name('employees.store-schedule');
    Route::post("/delete/{id}", "EmployeesController@destroy")->middleware(['demoModeCheck']);
    Route::delete("/attachments/{uniqueid}", "EmployeesController@deleteAttachment");
});
Route::resource('employees', 'EmployeesController');
Route::resource('employeeusers', 'EmployeesController');

//TEAM
Route::group(['prefix' => 'team'], function () {
    Route::any("/search", "Team@index");
    Route::get("/updatepreferences", "Team@updatePreferences");
});
Route::resource('team', 'Team');

Route::group(['prefix' => 'mails'], function () {
    Route::any("/search", "AddMail@index");
});
Route::resource('mails', 'AddMail');

//SETTINGS - USER
Route::group(['prefix' => 'user'], function () {
    Route::get("/avatar", "User@avatar");
    Route::put("/avatar", "User@updateAvatar")->middleware(['demoModeCheck']);
    Route::get("/notifications", "User@notifications");
    Route::put("/notifications", "User@updateNotifications");
    Route::get("/updatepassword", "User@updatePassword");
    Route::put("/updatepassword", "User@updatePasswordAction")->middleware(['demoModeCheck']);
    Route::get("/updatenotifications", "User@updateNotifications");
    Route::put("/updatenotifications", "User@updateNotificationsAction")->middleware(['demoModeCheck']);
    Route::post("/updatelanguage", "User@updateLanguage");
});

//INVOICES
Route::group(['prefix' => 'invoices'], function () {
    Route::any("/search", "Invoices@index");
    Route::post("/delete", "Invoices@destroy")->middleware(['demoModeCheck']);
    Route::get("/change-category", "Invoices@changeCategory");
    Route::post("/change-category", "Invoices@changeCategoryUpdate");
    Route::get("/add-payment", "Invoices@addPayment");
    Route::post("/add-payment", "Invoices@addPayment");
    Route::get("/{invoice}/clone", "Invoices@createClone")->where('invoice', '[0-9]+');
    Route::post("/{invoice}/clone", "Invoices@storeClone")->where('invoice', '[0-9]+');
    Route::get("/{invoice}/stop-recurring", "Invoices@stopRecurring")->where('invoice', '[0-9]+');
    Route::get("/{invoice}/attach-project", "Invoices@attachProject")->where('invoice', '[0-9]+');
    Route::post("/{invoice}/attach-project", "Invoices@attachProjectUpdate")->where('invoice', '[0-9]+');
    Route::get("/{invoice}/detach-project", "Invoices@dettachProject")->where('invoice', '[0-9]+');
    Route::get("/{invoice}/email-client", "Invoices@emailClient")->where('invoice', '[0-9]+');
    Route::get("/{invoice}/download-pdf", "Invoices@downloadPDF")->where('invoice', '[0-9]+');
    Route::get("/{invoice}/recurring-settings", "Invoices@recurringSettings")->where('invoice', '[0-9]+');
    Route::post("/{invoice}/recurring-settings", "Invoices@recurringSettingsUpdate")->where('invoice', '[0-9]+');
    Route::get("/{invoice}/edit-invoice", "Invoices@show")->where('invoice', '[0-9]+')->middleware(['invoicesMiddlewareEdit', 'invoicesMiddlewareShow']);
    Route::post("/{invoice}/edit-invoice", "Invoices@saveInvoice")->where('invoice', '[0-9]+');
    Route::get("/{invoice}/pdf", "Invoices@show")->where('invoice', '[0-9]+')->middleware(['invoicesMiddlewareShow']);
    Route::get("/{invoice}/publish", "Invoices@publishInvoice")->where('invoice', '[0-9]+')->middleware(['invoicesMiddlewareEdit', 'invoicesMiddlewareShow']);
    Route::get("/{invoice}/resend", "Invoices@resendInvoice")->where('invoice', '[0-9]+')->middleware(['invoicesMiddlewareEdit', 'invoicesMiddlewareShow']);
    Route::get("/{invoice}/stripe-payment", "Invoices@paymentStripe")->where('invoice', '[0-9]+');
    Route::get("/{invoice}/paypal-payment", "Invoices@paymentPaypal")->where('invoice', '[0-9]+');
    Route::get("/timebilling/{project}/", "Timebilling@index")->where('project', '[0-9]+');
});
Route::resource('invoices', 'Invoices');

//ESTIMATES
Route::group(['prefix' => 'estimates'], function () {
    Route::any("/search", "Estimates@index");
    Route::post("/delete", "Estimates@destroy")->middleware(['demoModeCheck']);
    Route::get("/change-category", "Estimates@changeCategory");
    Route::post("/change-category", "Estimates@changeCategoryUpdate");
    Route::get("/{estimate}/attach-project", "Estimates@attachProject")->where('estimate', '[0-9]+');
    Route::post("/{estimate}/attach-project", "Estimates@attachProjectUpdate")->where('invoice', '[0-9]+');
    Route::get("/{estimate}/detach-project", "Estimates@dettachProject")->where('estimate', '[0-9]+');
    Route::get("/{estimate}/email-client", "Estimates@emailClient")->where('estimate', '[0-9]+');
    Route::get("/{estimate}/convert-to-invoice", "Estimates@convertToInvoice")->where('estimate', '[0-9]+');
    Route::get("/{estimate}/change-status", "Estimates@changeStatus")->where('estimate', '[0-9]+');
    Route::post("/{estimate}/change-status", "Estimates@changeStatusUpdate")->where('estimate', '[0-9]+');
    Route::get("/{estimate}/edit-estimate", "Estimates@show")->where('estimate', '[0-9]+')->middleware(['estimatesMiddlewareEdit', 'estimatesMiddlewareShow']);
    Route::post("/{estimate}/edit-estimate", "Estimates@saveEstimate")->where('estimate', '[0-9]+');
    Route::get("/{estimate}/pdf", "Estimates@show")->where('estimate', '[0-9]+')->middleware(['estimatesMiddlewareShow']);
    Route::get("/{estimate}/publish", "Estimates@publishEstimate")->where('estimate', '[0-9]+')->middleware(['estimatesMiddlewareEdit', 'estimatesMiddlewareShow']);
    Route::get("/{estimate}/publish-revised", "Estimates@publishRevisedEstimate")->where('estimate', '[0-9]+')->middleware(['estimatesMiddlewareEdit', 'estimatesMiddlewareShow']);
    Route::get("/{estimate}/resend", "Estimates@resendEstimate")->where('estimate', '[0-9]+')->middleware(['estimatesMiddlewareEdit', 'estimatesMiddlewareShow']);
    Route::get("/{estimate}/accept", "Estimates@acceptEstimate")->where('estimate', '[0-9]+');
    Route::get("/{estimate}/decline", "Estimates@declineEstimate")->where('estimate', '[0-9]+');
});
Route::resource('estimates', 'Estimates');

//PAYMENTS
Route::group(['prefix' => 'payments'], function () {
    Route::any("/search", "Payments@index");
    Route::post("/delete", "Payments@destroy")->middleware(['demoModeCheck']);
    Route::get("/change-category", "Payments@changeCategory");
    Route::post("/change-category", "Payments@changeCategoryUpdate");
    Route::any("/v/{payment}", "Payments@index")->where('payment', '[0-9]+');
    Route::any("/thankyou", "Payments@thankYou");
});
Route::resource('payments', 'Payments');

//ITEMS
Route::group(['prefix' => 'items'], function () {
    Route::any("/search", "Items@index");
    Route::post("/delete", "Items@destroy")->middleware(['demoModeCheck']);
    Route::get("/change-category", "Items@changeCategory");
    Route::post("/change-category", "Items@changeCategoryUpdate");
});
Route::resource('items', 'Items');

//PRODUCTS (same as items above)
Route::group(['prefix' => 'products'], function () {
    Route::any("/search", "Items@index");
    Route::post("/delete", "Items@destroy")->middleware(['demoModeCheck']);
    Route::get("/change-category", "Items@changeCategory");
    Route::post("/change-category", "Items@changeCategoryUpdate");
});
Route::resource('products', 'Items');

//EXPENSES
Route::group(['prefix' => 'expenses'], function () {
    Route::any("/search", "Expenses@index");
    Route::get("/attachments/download/{uniqueid}", "Expenses@downloadAttachment");
    Route::delete("/attachments/{uniqueid}", "Expenses@deleteAttachment")->middleware(['demoModeCheck']);
    Route::post("/delete", "Expenses@destroy")->middleware(['demoModeCheck']);
    Route::get("/{expense}/attach-dettach", "Expenses@attachDettach")->where('invoice', '[0-9]+');
    Route::post("/{expense}/attach-dettach", "Expenses@attachDettachUpdate")->where('invoice', '[0-9]+');
    Route::get("/change-category", "Expenses@changeCategory");
    Route::post("/change-category", "Expenses@changeCategoryUpdate");
    Route::get("/{expense}/create-new-invoice", "Expenses@createNewInvoice")->where('expense', '[0-9]+');
    Route::post("/{expense}/create-new-invoice", "Expenses@createNewInvoice")->where('expense', '[0-9]+');
    Route::get("/{expense}/add-to-invoice", "Expenses@addToInvoice")->where('expense', '[0-9]+');
    Route::post("/{expense}/add-to-invoice", "Expenses@addToInvoice")->where('expense', '[0-9]+');
    Route::any("/v/{expense}", "Expenses@index")->where('expense', '[0-9]+');
});
Route::resource('expenses', 'Expenses');

//PROJECTS & PROJECT
Route::group(['prefix' => 'projects'], function () {
    Route::any("/search", "Projects@index");
    Route::post("/delete", "Projects@destroy")->middleware(['demoModeCheck']);
    Route::get("/change-category", "Projects@changeCategory");
    Route::post("/change-category", "Projects@changeCategoryUpdate");
    Route::get("/{project}/change-status", "Projects@changeStatus")->where('project', '[0-9]+');
    Route::post("/{project}/change-status", "Projects@changeStatusUpdate")->where('project', '[0-9]+');
    Route::get("/{project}/project-details", "Projects@details")->where('project', '[0-9]+');
    Route::post("/{project}/project-details", "Projects@updateDescription")->where('project', '[0-9]+');
    Route::put("/{project}/stop-all-timers", "Projects@stopAllTimers")->where('project', '[0-9]+');

    //dynamic load
    Route::any("/{project}/{section}", "Projects@showDynamic")
        ->where(['project' => '[0-9]+', 'section' => 'details|comments|files|tasks|invoices|payments|timesheets|expenses|estimates|milestones|tickets|notes']);
});
Route::resource('projects', 'Projects');


// Trustech routes
Route::group(['prefix' => 'properties'], function () {
    Route::any("/search", "Property@index");
    Route::post("/delete", "Property@destroy")->middleware(['demoModeCheck']);
    Route::get("/show-event/{id}", "Property@showEvent");

    //dynamic load
    Route::any("/{properties}/{section}", "Property@showDynamic")->where(['project' => '[0-9]+', 'section' => 'details|comments|files|tasks|invoices|payments|timesheets|expenses|estimates|milestones|tickets|notes|properties']);

    Route::delete("/attachments/{uniqueid}", "Property@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "Property@downloadAttachment");
    Route::get("/{id}/change-status", "Property@changeStatus");
    Route::post("/{id}/change-status", "Property@changeStatusUpdate");
});
Route::resource('properties', 'Property');
Route::get('/front/all-properties/', 'Property@frontProperties')->name('front.property.index');


// front users routes in crm
Route::group(['prefix' => 'frontusers'], function () {
    Route::any("/search", "FrontUsers@index");
    Route::post("/delete", "FrontUsers@destroy")->middleware(['demoModeCheck']);
    Route::get("/show-event/{id}", "FrontUsers@showEvent");

    Route::get("/{id}/change-status", "FrontUsers@changeStatus");
    Route::post("/{id}/change-status", "FrontUsers@changeStatusUpdate");
});
Route::resource('frontusers', 'FrontUsers');

// materials
Route::group(['prefix' => 'materials'], function () {
    Route::any("/search", "Material@index")->middleware('materialsMiddleware');
    Route::post("/delete", "Material@destroy")->middleware(['demoModeCheck']);
    Route::get("/show-event/{id}", "Material@showEvent")->middleware('materialsMiddleware');
});
Route::resource('materials', 'Material')->middleware('materialsMiddleware');

Route::resource('vendors', 'Vendor');

// end of vendor

// routes for rfms
Route::group(['prefix' => 'rfms'], function () {
    Route::any("/search", "Rfms@index");
    Route::post("/delete", "Rfms@destroy")->middleware(['demoModeCheck']);
    Route::delete("/attachments/{uniqueid}", "Rfms@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "Rfms@downloadAttachment");
    Route::get("/{id}/assign-hoa", "Rfms@assignHoa");
    Route::get("/{id}/send-to-admin", "Rfms@sendToAdmin");
    Route::get("/{id}/change-status", "Rfms@changeStatus")->name('assign.admin');
    Route::get("/{id}/pdf", "Rfms@show");
    // ->middleware('materialsMiddleware')
    Route::get("/{id}/edit-rfm", "Rfms@showRfm");
    // ->middleware('materialsMiddleware')
    Route::post("/rfm-material-store", "Rfms@storeMaterial")->name('rfm.store.material');
    Route::delete("/attachments/{uniqueid}", "Rfms@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "Rfms@downloadAttachment");
    Route::get("/{rfm}/send-admin", "Rfms@sendAdmin");
    Route::post("/{rfm}/send-admin", "Rfms@sendAdminUpdate");
    Route::get("/show-event/{id}", "Rfms@showEvent");
});
Route::resource('rfms', 'Rfms');
// end of  rfms routes
Route::get('show-event', function () {
    // $events = Event::latest()->paginate(30);
    $events = DB::table('events')
                  ->leftJoin('users', 'users.id', '=', 'events.event_creatorid')
                  ->latest('event_created')
                  ->paginate(40);
    return view('pages.show-event.wrapper',compact('events'));
});
Route::post('/filter-events', 'Events@filterEvents')->name('filter.events');

// routes for documents
Route::group(['prefix' => 'documents'], function () {
    Route::any("/search", "Documents@index");
    Route::post("/delete", "Documents@destroy")->middleware(['demoModeCheck']);
    Route::delete("/attachments/{uniqueid}", "Documents@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "Documents@downloadAttachment");
    Route::get("/show-event/{id}", "Documents@showEvent");
});
Route::resource('documents', 'Documents');

// routes for employee legal docs
Route::group(['prefix' => 'employeedocument'], function () {
    Route::any("/search", "EmployeLegalDocuments@index");
    Route::post("/delete", "EmployeLegalDocuments@destroy")->middleware(['demoModeCheck']);
    Route::delete("/attachments/{uniqueid}", "EmployeLegalDocuments@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "EmployeLegalDocuments@downloadAttachment");
    Route::get("/show-event/{id}", "EmployeLegalDocuments@showEvent");
});
Route::resource('employeedocument', 'EmployeLegalDocuments');

// contract mgt
Route::group(['prefix' => 'contractsmgt'], function () {
    Route::any("/search", "ContractMgt@index");
    Route::post("/delete", "ContractMgt@destroy")->middleware(['demoModeCheck']);
    Route::delete("/attachments/{uniqueid}", "ContractMgt@deleteAttachment")->middleware(['demoModeCheck']);
    Route::get("/attachments/download/{uniqueid}", "ContractMgt@downloadAttachment");
    Route::get("/show-event/{id}", "ContractMgt@showEvent");
});
Route::resource('contractsmgt', 'ContractMgt');

// Quotation
Route::group(['prefix' => 'quotations'], function () {
    Route::any("/search", "Quotation@index");
    Route::post("/delete", "Quotation@destroy")->middleware(['demoModeCheck']);
    Route::delete("/attachments/{uniqueid}", "Quotation@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "Quotation@downloadAttachment");
    Route::get("/show-event/{id}", "Quotation@showEvent");
});
Route::resource('quotations', 'Quotation');


// CRM Services
Route::group(['prefix' => 'services'], function () {
    Route::any("/search", "Services@index");
    Route::post("/delete", "Services@destroy")->middleware(['demoModeCheck']);
    Route::delete("/attachments/{uniqueid}", "Services@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "Services@downloadAttachment");
    // Route::get("/show-event/{id}", "Services@showEvent");
});
Route::resource('services', 'Services');

// LPO
Route::group(['prefix' => 'lpos'], function () {
    Route::any("/search", "Lpo@index");
    Route::post("/delete", "Lpo@destroy")->middleware(['demoModeCheck']);
    Route::delete("/attachments/{uniqueid}", "Lpo@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "Lpo@downloadAttachment");
    Route::get("/{id}/pdf", "Lpo@show");
    Route::get("/show-event/{id}", "Lpo@showEvent");
});
Route::resource('lpos', 'Lpo');

// end of trustech routes


//TASKS
Route::group(['prefix' => 'tasks'], function () {
    Route::any("/search", "Tasks@index");
    Route::any("/timer/{id}/start", "Tasks@timerStart")->where('id', '[0-9]+');
    Route::any("/timer/{id}/stop", "Tasks@timerStop")->where('id', '[0-9]+');
    Route::any("/timer/{id}/stopall", "Tasks@timerStopAll")->where('id', '[0-9]+');
    Route::post("/delete", "Tasks@destroy")->middleware(['demoModeCheck']);
    Route::post("/{task}/toggle-status", "Tasks@toggleStatus")->where('task', '[0-9]+');
    Route::post("/{task}/update-description", "Tasks@updateDescription")->where('task', '[0-9]+');
    Route::post("/{task}/attach-files", "Tasks@attachFiles")->where('task', '[0-9]+');
    Route::delete("/delete-attachment/{uniqueid}", "Tasks@deleteAttachment")->middleware(['demoModeCheck']);
    Route::get("/download-attachment/{uniqueid}", "Tasks@downloadAttachment");
    Route::post("/{task}/post-comment", "Tasks@storeComment")->where('task', '[0-9]+');
    Route::delete("/delete-comment/{commentid}", "Tasks@deleteComment")->where('commentid', '[0-9]+');
    Route::post("/{task}/update-title", "Tasks@updateTitle")->where('task', '[0-9]+');
    Route::post("/{task}/add-checklist", "Tasks@storeChecklist")->where('task', '[0-9]+');
    Route::post("/update-checklist/{checklistid}", "Tasks@updateChecklist")->where('checklistid', '[0-9]+');
    Route::delete("/delete-checklist/{checklistid}", "Tasks@deleteChecklist")->where('checklistid', '[0-9]+');
    Route::post("/toggle-checklist-status/{checklistid}", "Tasks@toggleChecklistStatus")->where('checklistid', '[0-9]+');
    Route::post("/{task}/update-start-date", "Tasks@updateStartDate")->where('task', '[0-9]+');
    Route::post("/{task}/update-due-date", "Tasks@updateDueDate")->where('task', '[0-9]+');
    Route::post("/{task}/update-status", "Tasks@updateStatus")->where('task', '[0-9]+');
    Route::post("/{task}/update-priority", "Tasks@updatePriority")->where('task', '[0-9]+');
    Route::post("/{task}/update-visibility", "Tasks@updateVisibility")->where('task', '[0-9]+');
    Route::post("/{task}/update-milestone", "Tasks@updateMilestone")->where('task', '[0-9]+');
    Route::post("/{task}/update-assigned", "Tasks@updateAssigned")->where('task', '[0-9]+');
    Route::post("/update-position", "Tasks@updatePosition");
    Route::any("/v/{task}/{slug}", "Tasks@index")->where('task', '[0-9]+');
});
Route::resource('tasks', 'Tasks');

//LEADS & LEAD
Route::group(['prefix' => 'leads'], function () {
    Route::any("/search", "Leads@index");
    Route::any("/{lead}/details", "Leads@details")->where('lead', '[0-9]+');
    Route::post("/delete", "Leads@destroy")->middleware(['demoModeCheck']);
    Route::get("/change-category", "Leads@changeCategory");
    Route::post("/change-category", "Leads@changeCategoryUpdate");
    Route::get("/{lead}/change-status", "Leads@changeStatus")->where('lead', '[0-9]+');
    Route::post("/{lead}/change-status", "Leads@changeStatusUpdate")->where('lead', '[0-9]+');
    Route::post("/{lead}/update-description", "Leads@updateDescription")->where('lead', '[0-9]+');
    Route::post("/{lead}/attach-files", "Leads@attachFiles")->where('lead', '[0-9]+');
    Route::delete("/delete-attachment/{uniqueid}", "Leads@deleteAttachment");
    Route::get("/download-attachment/{uniqueid}", "Leads@downloadAttachment");
    Route::post("/{lead}/update-title", "Leads@updateTitle")->where('lead', '[0-9]+');
    Route::post("/{lead}/post-comment", "Leads@storeComment")->where('lead', '[0-9]+');
    Route::delete("/delete-comment/{commentid}", "Leads@deleteComment")->where('commentid', '[0-9]+');
    Route::post("/{lead}/add-checklist", "Leads@storeChecklist")->where('lead', '[0-9]+');
    Route::post("/update-checklist/{checklistid}", "Leads@updateChecklist")->where('checklistid', '[0-9]+');
    Route::delete("/delete-checklist/{checklistid}", "Leads@deleteChecklist")->where('checklistid', '[0-9]+');
    Route::post("/toggle-checklist-status/{checklistid}", "Leads@toggleChecklistStatus")->where('checklistid', '[0-9]+');
    Route::post("/{lead}/update-date-added", "Leads@updateDateAdded")->where('lead', '[0-9]+');
    Route::post("/{lead}/update-name", "Leads@updateName")->where('lead', '[0-9]+');
    Route::post("/{lead}/update-value", "Leads@updateValue")->where('lead', '[0-9]+');
    Route::post("/{lead}/update-status", "Leads@updateStatus")->where('lead', '[0-9]+');
    Route::post("/{lead}/update-category", "Leads@updateCategory")->where('lead', '[0-9]+');
    Route::post("/{lead}/update-contacted", "Leads@updateContacted")->where('lead', '[0-9]+');
    Route::post("/{lead}/update-phone", "Leads@updatePhone")->where('lead', '[0-9]+');
    Route::post("/{lead}/update-email", "Leads@updateEmail")->where('lead', '[0-9]+');
    Route::post("/{lead}/update-source", "Leads@updateSource")->where('lead', '[0-9]+');
    Route::post("/{lead}/update-organisation", "Leads@updateOrganisation")->where('lead', '[0-9]+');
    Route::post("/{lead}/update-assigned", "Leads@updateAssigned")->where('lead', '[0-9]+');
    Route::post("/update-position", "Leads@updatePosition");
    Route::post("/{lead}/convert-lead", "Leads@convertLead")->where('lead', '[0-9]+');
    Route::any("/v/{lead}/{slug}", "Leads@index")->where('lead', '[0-9]+');
});
Route::resource('leads', 'Leads');

//TICKETS
Route::group(['prefix' => 'tickets'], function () {
    Route::any("/search", "Tickets@index");
    Route::get("/{x}/editdetails", "Tickets@editDetails")->where('x', '[0-9]+');
    Route::get("/{ticket}/reply", "Tickets@reply")->where('x', '[0-9]+');
    Route::post("/{ticket}/postreply", "Tickets@storeReply")->where('x', '[0-9]+');
    Route::post("/delete", "Tickets@destroy")->middleware(['demoModeCheck']);
    Route::get("/change-category", "Tickets@changeCategory");
    Route::post("/change-category", "Tickets@changeCategoryUpdate");
    Route::get("/attachments/download/{uniqueid}", "Tickets@downloadAttachment");
});
Route::resource('tickets', 'Tickets');

//REPORTS
Route::group(['prefix' => 'reports'], function () {
    Route::any("/", "Reports@index");
    Route::any("/search", "Reports@index");
});

//TIMELINE
Route::group(['prefix' => 'timeline'], function () {
    Route::any("/client", "Timeline@clientTimeline");
    Route::any("/project", "Timeline@projectTimeline");
});

//TIMESHEETS
Route::group(['prefix' => 'timesheets'], function () {
    Route::any("/my", "Timesheets@index");
    Route::any("/", "Timesheets@index");
    Route::any("/search", "Timesheets@index");
    Route::post("/delete", "Timesheets@destroy")->middleware(['demoModeCheck']);
});
Route::resource('timesheets', 'Timesheets');

//FILES
Route::group(['prefix' => 'files'], function () {
    Route::any("/search", "Files@index");
    Route::get("/getimage", "Files@showImage");
    Route::get("/download", "Files@download");
    Route::post("/delete", "Files@destroy")->middleware(['demoModeCheck']);
});
Route::resource('files', 'Files');

//NOTES
Route::group(['prefix' => 'notes'], function () {
    Route::any("/search", "Notes@index");
    Route::post("/delete", "Notes@destroy")->middleware(['demoModeCheck']);
});
Route::resource('notes', 'Notes');

//COMMENTS
Route::group(['prefix' => 'comments'], function () {
    Route::any("/search", "Comments@index");
    Route::post("/delete", "Comments@destroy")->middleware(['demoModeCheck']);
});
Route::resource('comments', 'Comments');

//AUTOCOMPLETE AJAX FEED
Route::group(['prefix' => 'feed'], function () {
    Route::get("/", "Feed@index");
    Route::get("/company_names", "Feed@companyNames");
    Route::get("/company_managers", "User@companyManagers");
    Route::get("/contacts", "Feed@contactNames");
    Route::get("/email", "Feed@emailAddress");
    Route::get("/tags", "Feed@tags");
    Route::get("/leads", "Feed@leads");
    Route::get("/projects", "Feed@projects");
    Route::get("/projectassigned", "Feed@projectAssignedUsers");
});

//PROJECTS & PROJECT
Route::group(['prefix' => 'feed'], function () {
    Route::any("/team", "Team@index"); //[TODO]  auth middleware
});

//MILESTONES
Route::group(['prefix' => 'milestones'], function () {
    Route::any("/search", "Milestones@index");
    Route::post("/update-positions", "Milestones@updatePositions");
});
Route::resource('milestones', 'Milestones');

//CATEGORIES
Route::group(['prefix' => 'categories'], function () {
    Route::any("/", "Categories@index");
});
Route::resource('categories', 'Categories');

//FILEUPLOAD
Route::post("/fileupload", "Fileupload@save");

//AVATAR FILEUPLOAD
Route::post("/avatarupload", "Fileupload@saveAvatar");

//CLIENT LOGO FILEUPLOAD
Route::post("/uploadlogo", "Fileupload@saveLogo");

//APP LOGO FILEUPLOAD
Route::post("/upload-app-logo", "Fileupload@saveAppLogo");

//TINYMCE IMAGE FILEUPLOAD
Route::post("/upload-tinymce-image", "Fileupload@saveTinyMCEImage");

//TAGS - GENERAL
Route::group(['prefix' => 'tags'], function () {
    Route::any("/search", "Tags@index");
});
Route::resource('tags', 'Tags');

//KNOWLEDGEBASE - CATEGORIES
Route::group(['prefix' => 'knowledgebase'], function () {
    //category
    Route::get("/", "KBCategories@index");
});
Route::resource('knowledgebase', 'KBCategories');

//KNOWLEDGEBASE - ARTICLES
Route::group(['prefix' => 'kb'], function () {
    //category
    Route::any("/search", "Knowledgebase@index");
    //pretty url domain.com/kb/12/some-category-title
    Route::any("/articles/{slug}", "Knowledgebase@index");
    Route::any("/article/{slug}", "Knowledgebase@show");
});
Route::resource('kb', 'Knowledgebase');

//SETTINGS - HOME
Route::group(['prefix' => 'settings'], function () {
    Route::get("/", "Settings\Home@index");
});

//SETTINGS - SYSTEM
Route::group(['prefix' => 'settings/system'], function () {
    Route::get("/clearcache", "Settings\System@clearLaravelCache");
});

//SETTINGS - GENERAL
Route::group(['prefix' => 'settings/general'], function () {
    Route::get("/", "Settings\General@index");
    Route::put("/", "Settings\General@update")->middleware(['demoModeCheck']);
});

//SETTINGS - COMPANY
Route::group(['prefix' => 'settings/company'], function () {
    Route::get("/", "Settings\Company@index");
    Route::put("/", "Settings\Company@update")->middleware(['demoModeCheck']);
});

//SETTINGS - THEME
Route::group(['prefix' => 'settings/theme'], function () {
    Route::get("/", "Settings\Theme@index");
    Route::put("/", "Settings\Theme@update")->middleware(['demoModeCheck']);
});

//SETTINGS - CLIENT
Route::group(['prefix' => 'settings/clients'], function () {
    Route::get("/", "Settings\Clients@index");
    Route::put("/", "Settings\Clients@update")->middleware(['demoModeCheck']);
});

//SETTINGS - TAGS
Route::group(['prefix' => 'settings/tags'], function () {
    Route::get("/", "Settings\Tags@index");
    Route::put("/", "Settings\Tags@update")->middleware(['demoModeCheck']);
});

//SETTINGS - PROJECT
Route::group(['prefix' => 'settings/projects'], function () {
    Route::get("/general", "Settings\Projects@general");
    Route::put("/general", "Settings\Projects@updateGeneral")->middleware(['demoModeCheck']);
    Route::get("/client", "Settings\Projects@clientPermissions");
    Route::put("/client", "Settings\Projects@updateClientPermissions")->middleware(['demoModeCheck']);
    Route::get("/staff", "Settings\Projects@staffPermissions");
    Route::put("/staff", "Settings\Projects@updateStaffPermissions")->middleware(['demoModeCheck']);
});

//SETTINGS - INVOICES
Route::group(['prefix' => 'settings/invoices'], function () {
    Route::get("/", "Settings\Invoices@index");
    Route::put("/", "Settings\Invoices@update")->middleware(['demoModeCheck']);
});

//SETTINGS - UNITS
Route::group(['prefix' => 'settings/units'], function () {
    Route::get("/", "Settings\Units@index");
    Route::put("/", "Settings\Units@update")->middleware(['demoModeCheck']);
});
Route::resource('settings/units', 'Settings\Units');

//SETTINGS - TAX RATES
Route::group(['prefix' => 'settings/taxrates'], function () {
    Route::get("/", "Settings\Taxrates@index");
    Route::put("/", "Settings\Taxrates@update")->middleware(['demoModeCheck']);
});
Route::resource('settings/taxrates', 'Settings\Taxrates');

//SETTINGS - ESTIMATES
Route::group(['prefix' => 'settings/estimates'], function () {
    Route::get("/", "Settings\Estimates@index");
    Route::put("/", "Settings\Estimates@update")->middleware(['demoModeCheck']);
});

//SETTINGS - EXPENSES
Route::group(['prefix' => 'settings/expenses'], function () {
    Route::get("/", "Settings\Expenses@index");
    Route::put("/", "Settings\Expenses@update")->middleware(['demoModeCheck']);
});

//SETTINGS - STRIPE
Route::group(['prefix' => 'settings/stripe'], function () {
    Route::get("/", "Settings\Stripe@index")->middleware(['demoModeCheck']);
    Route::put("/", "Settings\Stripe@update")->middleware(['demoModeCheck']);
});

//SETTINGS - PAYPAL
Route::group(['prefix' => 'settings/paypal'], function () {
    Route::get("/", "Settings\Paypal@index")->middleware(['demoModeCheck']);
    Route::put("/", "Settings\Paypal@update")->middleware(['demoModeCheck']);
});

//SETTINGS - BANK
Route::group(['prefix' => 'settings/bank'], function () {
    Route::get("/", "Settings\Bank@index");
    Route::put("/", "Settings\Bank@update")->middleware(['demoModeCheck']);
});

//SETTINGS - LEADS
Route::group(['prefix' => 'settings/leads'], function () {
    Route::get("/general", "Settings\Leads@general");
    Route::put("/general", "Settings\Leads@updateGeneral");
    Route::get("/statuses", "Settings\Leads@statuses");
    Route::put("/statuses", "Settings\Leads@updateStatuses")->middleware(['demoModeCheck']);
    Route::get("/statuses/{id}/edit", "Settings\Leads@editStatus")->where('lead', '[0-9]+');
    Route::put("/statuses/{id}", "Settings\Leads@updateStatus")->where('lead', '[0-9]+')->middleware(['demoModeCheck']);
    Route::get("/statuses/create", "Settings\Leads@createStatus");
    Route::post("/statuses/create", "Settings\Leads@storeStatus");
    Route::get("/move/{id}", "Settings\Leads@move")->where('id', '[0-9]+');
    Route::put("/move/{id}", "Settings\Leads@updateMove")->where('id', '[0-9]+');
    Route::delete("/statuses/{id}", "Settings\Leads@destroyStatus")->where('id', '[0-9]+')->middleware(['demoModeCheck']);
    Route::post("/update-stage-positions", "Settings\Leads@updateStagePositions");
});

//SETTINGS - MILESTONES
Route::group(['prefix' => 'settings/milestones'], function () {
    Route::get("/settings", "Settings\Milestones@index");
    Route::put("/settings", "Settings\Milestones@update")->middleware(['demoModeCheck']);
    Route::get("/default", "Settings\Milestones@categories");
    Route::get("/create", "Settings\Milestones@create");
    Route::post("/create", "Settings\Milestones@storeCategory")->middleware(['demoModeCheck']);
    Route::get("/{id}/edit", "Settings\Milestones@editCategory")->where('id', '[0-9]+');
    Route::put("/{id}", "Settings\Milestones@updateCategory")->where('id', '[0-9]+')->middleware(['demoModeCheck']);
    Route::post("/update-positions", "Settings\Milestones@updateCategoryPositions");
    Route::delete("/{id}", "Settings\Milestones@destroy")->where('id', '[0-9]+')->middleware(['demoModeCheck']);
});

//SETTINGS - knowledgebase
Route::group(['prefix' => 'settings/knowledgebase'], function () {
    Route::get("/settings", "Settings\Knowledgebase@index");
    Route::put("/settings", "Settings\Knowledgebase@update")->middleware(['demoModeCheck']);
    Route::get("/default", "Settings\Knowledgebase@categories");
    Route::get("/create", "Settings\Knowledgebase@create");
    Route::post("/create", "Settings\Knowledgebase@storeCategory")->middleware(['demoModeCheck']);
    Route::get("/{id}/edit", "Settings\Knowledgebase@editCategory")->where('id', '[0-9]+');
    Route::put("/{id}", "Settings\Knowledgebase@updateCategory")->where('id', '[0-9]+')->middleware(['demoModeCheck']);
    Route::post("/update-positions", "Settings\Knowledgebase@updateCategoryPositions");
    Route::delete("/{id}", "Settings\Knowledgebase@destroy")->where('id', '[0-9]+')->middleware(['demoModeCheck']);
});

//SETTINGS - LEAD SOURCES
Route::group(['prefix' => 'settings/sources'], function () {
    Route::get("/", "Settings\Sources@index");
    Route::put("/", "Settings\Sources@update")->middleware(['demoModeCheck']);
});
Route::resource('settings/sources', 'Settings\Sources');

//SETTINGS - TASKS
Route::group(['prefix' => 'settings/tasks'], function () {
    Route::get("/", "Settings\Tasks@index");
    Route::put("/", "Settings\Tasks@update")->middleware(['demoModeCheck']);
});

//SETTINGS - EMAIL
Route::group(['prefix' => 'settings/email'], function () {
    Route::get("/general", "Settings\Email@general");
    Route::put("/general", "Settings\Email@updateGeneral")->middleware(['demoModeCheck']);
    Route::get("/smtp", "Settings\Email@smtp")->middleware(['demoModeCheck']);
    Route::put("/smtp", "Settings\Email@updateSMTP")->middleware(['demoModeCheck']);
    Route::get("/templates", "Settings\Emailtemplates@index");
    Route::get("/templates/{id}", "Settings\Emailtemplates@show")->where('id', '[0-9]+');
    Route::post("/templates/{id}", "Settings\Emailtemplates@update")->where('id', '[0-9]+')->middleware(['demoModeCheck']);
});

//SETTINGS - UPDATES
Route::group(['prefix' => 'settings/updates'], function () {
    Route::get("/", "Settings\Updates@index");
    Route::post("/check", "Settings\Updates@checkUpdates");
});

//SETTINGS - ROLES
Route::group(['prefix' => 'settings/roles'], function () {
    Route::get("/", "Settings\Roles@index");
    Route::put("/", "Settings\Roles@update")->middleware(['demoModeCheck']);
});
Route::resource('settings/roles', 'Settings\Roles');
Route::post("/settings/roles", "Settings\Roles@Store")->middleware(['demoModeCheck']);



//SETTINGS - CLIENTS
Route::group(['prefix' => 'settings/clients'], function () {
    Route::get("/", "Settings\Clients@index");
    Route::put("/", "Settings\Clients@update")->middleware(['demoModeCheck']);
});

//SETTINGS - TICKETS
Route::group(['prefix' => 'settings/tickets'], function () {
    Route::get("/", "Settings\Tickets@index");
    Route::put("/", "Settings\Tickets@update")->middleware(['demoModeCheck']);
});

//SETTINGS - LOGO
Route::group(['prefix' => 'settings/logos'], function () {
    Route::get("/", "Settings\Logos@index");
    Route::get("/uploadlogo", "Settings\Logos@logo");
    Route::put("/uploadlogo", "Settings\Logos@updateLogo")->middleware(['demoModeCheck']);
});

//SETTINGS - DYNAMIC URLS's
Route::group(['prefix' => 'app/settings'], function () {
    Route::get("/{any}", "Settings\Dynamic@showDynamic")->where(['any' => '.*']);
});
Route::get("app/categories", "Settings\Dynamic@showDynamic");
Route::get("app/tags", "Settings\Dynamic@showDynamic");

//SETTINGS - CRONJOBS
Route::get("/settings/cronjobs", "Settings\Cronjobs@index");


//SETTINGS - TASKS
Route::group(['prefix' => 'settings/subscriptions'], function () {
    Route::get("/plans", "Settings\Subscriptions@plans");
    Route::get("/plans/create", "Settings\Subscriptions@createPlan");
    Route::post("/plans", "Settings\Subscriptions@storePlan")->middleware(['demoModeCheck']);
    Route::put("/plans", "Settings\Subscriptions@updatePlan")->middleware(['demoModeCheck']);
});


//EVENTS - TIMELINE
Route::group(['prefix' => 'events'], function () {
    Route::get("/topnav", "Events@topNavEvents");
    Route::get("/{id}/mark-read-my-event", "Events@markMyEventRead")->where('id', '[0-9]+');
    Route::get("/mark-allread-my-events", "Events@markAllMyEventRead");
});

//WEBHOOKS & IPN API
Route::group(['prefix' => 'api'], function () {
    Route::any("/stripe/webhooks", "API\Stripe\Webhooks@index");
    Route::any("/paypal/ipn", "API\Paypal\Ipn@index");
});

//POLLING
Route::group(['prefix' => 'polling'], function () {
    Route::get("/general", "Polling@generalPoll");
    Route::post("/timers", "Polling@timersPoll");
});

//SETUP GROUP (with group route name 'setup'
Route::group(['prefix' => 'setup', 'as' => 'setup'], function () {
    //requirements
    Route::get("/requirements", "Setup\Setup@checkRequirements");
    //server phpinfo()
    Route::get("/serverinfo", "Setup\Setup@serverInfo");
    //database
    Route::get("/database", "Setup\Setup@showDatabase");
    Route::post("/database", "Setup\Setup@updateDatabase");
    //settings
    Route::get("/settings", "Setup\Setup@showSettings");
    Route::post("/settings", "Setup\Setup@updateSettings");
    //admin user
    Route::get("/adminuser", "Setup\Setup@showUser");
    Route::post("/adminuser", "Setup\Setup@updateUser");
    //load first page -put this as last item
    Route::any("/", "Setup\Setup@index");
});


// trustech code starts here
Route::get('/authentiacate/invoice/{id}','Invoices@authenticateInvoice')->name('client.authenticateInvoice');
Route::get('/accept/invoice/{id}','Invoices@acceptInvoice')->name('admin.acceptInvoice');
Route::get('/download/invoice/{id}','Invoices@downloadInvoice')->name('download.Invoice');
// new

Route::name('front.')->group(function(){
Route::get('/front/our-policies/', 'FrontendController@footerOurPolicies')->name('footer.our-policies');
Route::get('/front/individual-Service-Policy/', 'FrontendController@individualServicePolicy')
->name('footer.individual-service-policy');
Route::get('/front/all-rights-reserved/', 'FrontendController@footerAllRightsReserved')->name('footer.all-rights-reserved');
Route::get('/front/terms-condition/', 'FrontendController@footerTermsCondition')->name('footer.terms-condition');
Route::get('/front/privacy-policy/', 'FrontendController@footerPrivacyPolicy')->name('footer.privacy-policy');
Route::get('/front/subscribtion-policy/', 'FrontendController@footerSubscribtionPolicy')->name('footer.subscribtion-policy');
Route::get('/front/all-cookies-policy/', 'FrontendController@footerCookiesPolicy')->name('footer.all-cookies-policy');
Route::get('/front/legal-regisatration/', 'FrontendController@footerlegalRegistration')->name('footer.legal-regisatration');
Route::post('/front/legal-regisatration/mail', 'FrontendController@legalRegistrationMail')->name('legalRegistration.mail');

Route::get('/CAFM/portal', 'FrontendController@CAFMportal')->name('CAFM.portal');

Route::get('category/wise/products/{id}', 'FrontendController@categoryWiseProducts')->name('category.products');
Route::get('/front/all-properties/', 'FrontendController@frontProperties')->name('property.index');
Route::get('/front/create-properties/', 'FrontendController@createProperty')->name('property.create');
Route::post('/front/properties/store/', 'FrontendController@storeProperty')->name('property.store');
Route::post('/front/properties/search/', 'FrontendController@searchProperty')->name('properties.search');


//complain us
Route::get('/user/complain/us', function(){
    return view('front-end.complain.complain'); })->name('user-complain-us');
Route::post('/user/complain/us/{type?}', 'FrontendController@submitComplain')->name('submit-usercomplain');


//mzad changes trustech
Route::get('/property/detail/{id}', 'FrontendController@frontPropertyDetails')->name('property.details');
Route::get('/product/detail/{id}', 'FrontendController@frontProductDetails')->name('product.details');


Route::get('/know-us', 'FrontendController@know_us')->name('know-us');
Route::get('/vision-mission', 'FrontendController@vision_mission')->name('vision-mission');
Route::get('/board-members', 'FrontendController@board_members')->name('board-members');
Route::get('/board-members-message', 'FrontendController@board_members_message')->name('board-members-message');
Route::get('/why-choose-us', 'FrontendController@why_choose_us')->name('why-choose-us');
Route::get('/business-ethics', 'FrontendController@business_ethics')->name('business-ethics');
Route::get('/organization-chart', 'FrontendController@organization_chart')->name('organization-chart');

Route::get('/retail-services', 'FrontendController@retail_services')->name('retail-services');
Route::get('/show-service/{id}', 'FrontendController@show_service')->name('service.details');
Route::get('/corporate-services', 'FrontendController@corporate_services')->name('corporate-services');
Route::get('/corporate-services/{id}', 'FrontendController@SingleCorporateServices')->name('single-corporate-services');

Route::get('/enivromental-policy','FrontendController@enivromental_policy')->name('enivromental-policy');
Route::get('/health-safety-policy','FrontendController@health_safety_policy')->name('health-safety-policy');
Route::get('/quality-assurance-policy','FrontendController@quality_assurance_policy')->name('quality-assurance-policy');
Route::get('/contact-us','FrontendController@contact_us')->name('contact-us');
Route::get('/career','FrontendController@career')->name('career');

// career apply and current now routes

Route::get('/career/apply/now/{category?}/{position?}','FrontendController@careerApplyNow')->name('careerApply');
Route::post('/career/apply/now','FrontendController@careerApplyNowSubmit')->name('careerApplySubmit');


// career apply and current now routes
Route::get('/career/apply/now','FrontendController@careerApplyNow')->name('careerApply');
Route::post('/career/apply/now','FrontendController@careerApplyNowSubmit')->name('careerApplySubmit');
Route::get('/career/current/openings','FrontendController@careerCurrentOpennings')->name('careerOpenings');


Route::get('/about-us','FrontendController@about_us')->name('about-us');
Route::get('/our-clients','FrontendController@our_clients')->name('our-clients');

//our projects routes   
Route::get('/our-projects','FrontendController@our_projects')->name('our-projects');


//to download pdf from rfq form
Route::get('vendor/help','FrontVendor\FrontVendorController@helpView')
->name('vendor.help')->middleware('frontVendorMiddleware');

//show profile edit form
Route::get('vendor/proflie','FrontVendor\FrontVendorController@profileSetting')
->name('vendor.profile')->middleware('frontVendorMiddleware');

//submit profile edit form
Route::put('vendor/proflie/{id}','FrontVendor\FrontVendorController@UpdateProfileSetting')
->name('vendor.profile.update')->middleware('frontVendorMiddleware');


//to download pdf from rfq form
Route::get('vendor/pdf/{id}/{clientId}','FrontVendor\FrontVendorRfqController@createPdf')
->name('vendor.rfq.pdf')->middleware('frontVendorMiddleware');

//vendor login view
Route::get('/front/vendor/login','FrontVendor\FrontVendorController@vendorLoginForm')
->name('vendor.login');

//vendor login form submition
Route::post('/front/vendor/login','FrontVendor\FrontVendorController@vendorLoginSuccess')
->name('vendor.loggedin');


//vendor logout from dashboard
Route::get('/front/vendor/logut','FrontVendor\FrontVendorController@vendorLogOut')
->name('vendor.logout');

//vendor registratio form view
Route::get('/front/vendor/registration','FrontVendor\FrontVendorController@register')
->name('vendor.register');

// email ajax validation
Route::get('testUrl', function(){
    $store = DB::table('users')->select('email')->where('email',request()->id)->first(); 
    if($store){
        return 1;
    }else{
        return 2;
    }
});


   //frontuser routes
    Route::get('/front/frontuser/registration', 'FrontUser\FrontUserController@register')
        ->name('user.register');
    //user login view
    Route::get('/front/user/login/{title?}', 'FrontUser\FrontUserController@userLoginForm')
        ->name('user.login');


    //user login form submition
    Route::post('/front/user/login', 'FrontUser\FrontUserController@userLoginAction')
        ->name('user.loggedin');

    // user register
    Route::post('front/user/store', 'FrontUser\FrontUserController@registerAction')->name('user.store');

    //user listing route
    Route::get('/front/user/dashboard/', 'FrontUser\FrontUserController@userDashboard')->name('user.dashboard');
    Route::get('/front/user-property/edit/{id}', 'FrontUser\FrontUserController@editProperty')->name('user.property.edit');
    Route::put('/front/user-property/update/{id}', 'FrontUser\FrontUserController@updateProperty')->name('user.property.update');
    Route::get('/front/user-property/delete/{id}', 'FrontUser\FrontUserController@deleteProperty')->name('user.property.delete');

    Route::get('checkemail', function () {
        // return request()->all();
        $email = User::where('email', request()->id)->first();
        if ($email) {
            return true;
        } else {
            return false;
        }
    });

    // end frontusers routes

  // front end employees
     Route::get('fetch-employee', 'FrontendController@fetchEmployee');
    Route::get('fetch-employee-schedules', 'FrontendController@fetchEmployeeSchedules');
    Route::get('employee-schedules/', 'FrontendController@employeeDashboard')->name('employee-dashboard')->middleware('auth');
    // Route::get('employee-schedules/bookings/details', 'FrontendController@employeeCalendarSchedules')->name('employee.schedule.details');

    // new routes for schedules
    Route::get("/service-employee-schedules/{id?}/{serviceid?}", "FrontendController@scheduleView")->name('employees.add-schedule');
    // Route::get("/fetch-schedules/{id}", "FrontendController@fetchSchedules")->name('employees.fetch-schedule');
    Route::post("/service-employee-schedules/", "FrontendController@storeSchedule")->name('employees.store-schedule');
    Route::get('/booking/pdf/download/{id}', 'FrontendController@pdfDownload');
    Route::get('/store-service/{price}/{description}', function ($price, $description) {
        session()->forget('price');
        session()->forget('description');
        session()->put('price', $price);
        session()->put('description', $description);
        return true;
    })->name('store.service');
    // new routes for schedules



     Route::post('booked-schedules/{id}', 'FrontendController@bookedSchedule')->name('booked-schedule');
    Route::post('store-booking/', 'FrontendController@storeBooking')->name('booking.store');
     Route::put('booking/change-status/','FrontendController@updateBookingStatus')->name('booking.status.update');
//vendor dashboard
Route::get('front/vendor/dashboard','FrontVendor\FrontVendorController@index')
->name('vendor.index')->middleware('frontVendorMiddleware');

//registration form submit
Route::post('front/vendor/store','FrontVendor\FrontVendorController@store')->name('vendor.store');


//vendor dashboard group middleware
Route::middleware('frontVendorMiddleware')->group(function () {
    // vendor INVOICE front end routes ends here
    Route::get('vendor/invoice/delete/{id}','FrontVendor\FrontVendorInvoiceController@destroy')->name('vendor.invoice.delete');
    Route::resource('vendorInvoice', 'FrontVendor\FrontVendorInvoiceController');
    Route::get("poCatTotal", "FrontVendor\FrontVendorInvoiceController@getCatTotal");
    
    // vendor Quotation front end routes ends here
    Route::get('vendorQuotation/delete/{id}','FrontVendor\FrontvendorQuotationController@destroy')
    ->name('vendor.Quotation.delete');
    Route::resource('vendorQuotation', 'FrontVendor\FrontVendorQuotationController');
    Route::get("rfqCategory", "FrontVendor\FrontVendorQuotationController@getCategory");
    // vendor Po front end routes ends here
    Route::get('vendorPo/delete/{id}','FrontVendor\FrontVendorPoController@destroy')->name('vendor.Po.delete');
    Route::resource('vendorPo', 'FrontVendor\FrontVendorPoController');

    // vendor VGC front end routes ends here
    Route::get('vendorVgc/delete/{id}','FrontVendor\FrontVendorRfqController@destroy')->name('vendor.Vgc.delete');
    Route::resource('vendorVgc', 'FrontVendor\FrontVendorRfqController');
});


});//front end routes

// Trustech routes

Route::group(['prefix' => 'properties'], function () {
    Route::any("/search", "Property@index");
    Route::post("/delete", "Property@destroy")->middleware(['demoModeCheck']);
    //dynamic load
    Route::any("/{properties}/{section}", "Property@showDynamic")
        ->where(['project' => '[0-9]+', 'section' => 'details|comments|files|tasks|invoices|payments|timesheets|expenses|estimates|milestones|tickets|notes|properties']);
});
Route::resource('properties', 'Property');

// routes for vendor
Route::group(['prefix' => 'rfms'], function () {
    Route::any("/search", "Vendor@index");
    Route::post("/delete", "Vendor@destroy")->middleware(['demoModeCheck']);
    
});

Route::resource('vendors', 'Vendor');

// end of vendor

// routes for rfms
Route::group(['prefix' => 'rfms'], function () {
    Route::any("/search", "Rfms@index");
    Route::post("/delete", "Rfms@destroy")->middleware(['demoModeCheck']);
});
Route::resource('rfms', 'Rfms');
// end of  rfms routes

// routes for documents
Route::group(['prefix' => 'documents'], function () {
    Route::any("/search", "Documents@index");
    Route::post("/delete", "Documents@destroy")->middleware(['demoModeCheck']);
        Route::get("/show-event/{id}", "Documents@showEvent");

    //  Route::any("/{documents}/{section}", "Documents@showDynamic")
    //     ->where(['document' => '[0-9]+', 'section' => 'details|comments|files|tasks|invoices|payments|timesheets|expenses|estimates|milestones|tickets|notes|properties|documents']);
});
Route::resource('documents', 'Documents');
// end of  documents routes
// routes for bookings
Route::group(['prefix' => 'bookings'], function () {
    Route::any("/search", "AdminEmployeeBooking@index");
    Route::post("/delete", "AdminEmployeeBooking@destroy")->middleware(['demoModeCheck']);
    Route::delete("/attachments/{uniqueid}", "AdminEmployeeBooking@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "AdminEmployeeBooking@downloadAttachment");
    
     Route::get("/{id}/change-status", "AdminEmployeeBooking@changeStatus");
    Route::post("/{id}/change-status", "AdminEmployeeBooking@changeStatusUpdate");
});
Route::resource('bookings', 'AdminEmployeeBooking');
// routes for govtdocuments
Route::group(['prefix' => 'govtdocuments'], function () {
    Route::any("/search", "GovtDocuments@index");
    Route::post("/delete", "GovtDocuments@destroy")->middleware(['demoModeCheck']);
    Route::delete("/attachments/{uniqueid}", "GovtDocuments@deleteAttachment")->middleware(['demoModeCheck']);
    Route::get("/attachments/download/{uniqueid}", "GovtDocuments@downloadAttachment");
    Route::get("/show-event/{id}", "GovtDocuments@showEvent");
});
Route::resource('govtdocuments', 'GovtDocuments');
// end of  govtdocuments routes


// routes for vendorrfq
Route::group(['prefix' => 'vendorrfqs'], function () {
    Route::any("/search", "VendorRfqs@index");
    Route::post("/delete", "VendorRfqs@destroy")->middleware(['demoModeCheck']);
    Route::delete("/attachments/{uniqueid}", "VendorRfqs@deleteAttachment")->middleware(['demoModeCheck']);
    Route::get("/attachments/download/{uniqueid}", "VendorRfqs@downloadAttachment")->name('rfq.attachment');
    //multi items vendor rfq
    Route::get("/add/items/{id}/{rfq?}", "VendorRfqs@addItems");
    Route::post("/add/items", "VendorRfqs@storeItem")->name('ritem.store.material');//route edited for the attachment rfq
    //show event 
    Route::get("/show-event/{id}", "VendorRfqs@showEvent");
    
});
//route added for rfq to show qtn
Route::get("/user/{id}/rfq/{rfq}", "VendorRfqs@userQtn")->name('rfq.user.qtn');
Route::resource('vendorrfqs', 'VendorRfqs');
// end of  vendorrfq routes

// routes for vendorqtn
Route::group(['prefix' => 'vendorqtns'], function () {
    Route::any("/search", "VendorQtns@index");
    Route::post("/delete", "VendorQtns@destroy")->middleware(['demoModeCheck']);
    //show event 
    Route::get("/show-event/{id}", "VendorQtns@showEvent");
});
//to download pdf from qtn form
Route::get('qtn/pdf/{id}','VendorQtns@createPdf')->name('vendor.qtn.pdf');

//route to update the quotation status
Route::put('/update/vendorquotation/{id}','VendorQtns@vendorUpdateQuotation')->name('vendor.qtn.update');
Route::resource('vendorqtns', 'VendorQtns');
// end of  vendorQtn routes


// routes for vendorinvoice
Route::group(['prefix' => 'vendorinvoices'], function () {
    Route::any("/search", "VendorInvoices@index");
    Route::post("/delete", "VendorInvoices@destroy")->middleware(['demoModeCheck']);
    //show event 
    Route::get("/show-event/{id}", "VendorInvoices@showEvent");
});
Route::resource('vendorinvoices', 'VendorInvoices');
// end of  vendorInvoice routes


// routes for vendor pos
Route::group(['prefix' => 'vendorpos'], function () {
    Route::any("/search", "VendorPos@index");
    Route::post("/delete", "VendorPos@destroy")->middleware(['demoModeCheck']);
    Route::delete("/attachments/{uniqueid}", "VendorPos@deleteAttachment")->middleware(['demoModeCheck']);
    Route::get("/attachments/download/{uniqueid}", "VendorPos@downloadAttachment");
    //show event 
    Route::get("/show-event/{id}", "VendorPos@showEvent");

});
Route::resource('vendorpos', 'VendorPos');
Route::get("qtnCatTotal", "VendorPos@getQtnCatTotal");
// end of vendor pos

// Trustech frontprojects routes
Route::group(['prefix' => 'frontprojects'], function () {
    Route::any("/search", "FrontProjects@index");
    Route::post("/delete", "FrontProjects@destroy")->middleware(['demoModeCheck']);
    Route::get("/show-event/{id}", "FrontProjects@showEvent");

    //dynamic load
    Route::any("/{frontprojects}/{section}", "FrontProjects@showDynamic")->where(['project' => '[0-9]+', 'section' => 'details|comments|files|tasks|invoices|payments|timesheets|expenses|estimates|milestones|tickets|notes|frontprojects']);

    Route::delete("/attachments/{uniqueid}", "FrontProjects@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "FrontProjects@downloadAttachment");
});
Route::resource('frontprojects', 'FrontProjects');
Route::get('/front/all-frontprojects/', 'FrontProjects@frontfrontprojects')->name('front.frontproject.index');
//front project routes ended


// Trustech frontclients routes
Route::group(['prefix' => 'frontclients'], function () {
    Route::any("/search", "FrontClients@index");
    Route::post("/delete", "FrontClients@destroy")->middleware(['demoModeCheck']);
    Route::get("/show-event/{id}", "FrontClients@showEvent");

    //dynamic load
    Route::any("/{frontclients}/{section}", "FrontClients@showDynamic")->where(['client' => '[0-9]+', 'section' => 'details|comments|files|tasks|invoices|payments|timesheets|expenses|estimates|milestones|tickets|notes|frontclients']);

    Route::delete("/attachments/{uniqueid}", "FrontClients@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "FrontClients@downloadAttachment");
    Route::get("/show-event/{id}", "FrontClients@showEvent");
});
Route::resource('frontclients', 'FrontClients');
//front client routes ended

// Trustech frontbanners routes
Route::group(['prefix' => 'frontbanners'], function () {
    Route::any("/search", "FrontBanners@index");
    Route::post("/delete", "FrontBanners@destroy")->middleware(['demoModeCheck']);
    Route::get("/show-event/{id}", "FrontBanners@showEvent");

    //dynamic load
    Route::any("/{frontbanners}/{section}", "FrontBanners@showDynamic")->where(['banner' => '[0-9]+', 'section' => 'details|comments|files|tasks|invoices|payments|timesheets|expenses|estimates|milestones|tickets|notes|frontbanners']);

    Route::delete("/attachments/{uniqueid}", "FrontBanners@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "FrontBanners@downloadAttachment");
    Route::get("/show-event/{id}", "FrontBanners@showEvent");
});
Route::resource('frontbanners', 'FrontBanners');
//frontbanners routes ended


// Trustech frontcareers routes
Route::group(['prefix' => 'frontcareers'], function () {
    Route::any("/search", "FrontCareers@index");
    Route::post("/delete", "FrontCareers@destroy")->middleware(['demoModeCheck']);
    Route::get("/show-event/{id}", "FrontCareers@showEvent");

    //dynamic load
    Route::any("/{frontcareers}/{section}", "FrontCareers@showDynamic")->where(['career' => '[0-9]+', 'section' => 'details|comments|files|tasks|invoices|payments|timesheets|expenses|estimates|milestones|tickets|notes|frontcareers']);

    Route::delete("/attachments/{uniqueid}", "FrontCareers@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "FrontCareers@downloadAttachment");
    Route::get("/show-event/{id}", "FrontCareers@showEvent");
});
Route::resource('frontcareers', 'FrontCareers');
//front career routes ended

// Trustech corporateservices routes
Route::group(['prefix' => 'corporateservices'], function () {
    Route::any("/search", "CorporateServices@index");
    Route::post("/delete", "CorporateServices@destroy")->middleware(['demoModeCheck']);
    Route::get("/show-event/{id}", "CorporateServices@showEvent");

    //dynamic load
    Route::any("/{corporateservices}/{section}", "CorporateServices@showDynamic")->where(['career' => '[0-9]+', 'section' => 'details|comments|files|tasks|invoices|payments|timesheets|expenses|estimates|milestones|tickets|notes|corporateservices']);

    Route::delete("/attachments/{uniqueid}", "CorporateServices@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "CorporateServices@downloadAttachment");
    Route::get("/show-event/{id}", "CorporateServices@showEvent");
});
Route::resource('corporateservices', 'CorporateServices');
//CoporateServices routes ended

// Trustech subcorporateservices routes
Route::group(['prefix' => 'subcorporateservices'], function () {
    Route::any("/search", "SubCorporateServices@index");
    Route::post("/delete", "SubCorporateServices@destroy")->middleware(['demoModeCheck']);
    Route::get("/show-event/{id}", "SubCorporateServices@showEvent");

    //dynamic load
    Route::any("/{subcorporateservices}/{section}", "SubCorporateServices@showDynamic")->where(['career' => '[0-9]+', 'section' => 'details|comments|files|tasks|invoices|payments|timesheets|expenses|estimates|milestones|tickets|notes|subcorporateservices']);

    Route::delete("/attachments/{uniqueid}", "SubCorporateServices@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "SubCorporateServices@downloadAttachment");
    Route::get("/show-event/{id}", "SubCorporateServices@showEvent");
});
Route::resource('subcorporateservices', 'SubCorporateServices');
Route::get('/subcorporate-services/{id}', 'FrontendController@SingleSubcorporateServices')->name('front.single-subcorporate-services');
//subcorporateservices routes ended


// Trustech subproducts routes
Route::group(['prefix' => 'subproducts'], function () {
Route::any("/search", "SubProducts@index");
Route::post("/delete", "SubProducts@destroy")->middleware(['demoModeCheck']);
Route::get("/show-event/{id}", "SubProducts@showEvent");

//dynamic load
Route::any("/{subproducts}/{section}", "SubProducts@showDynamic")->where(['career' => '[0-9]+',
'section' =>
'details|comments|files|tasks|invoices|payments|timesheets|expenses|estimates|milestones|tickets|notes|subproducts']);

Route::delete("/attachments/{uniqueid}", "SubProducts@deleteAttachment");
Route::get("/attachments/download/{uniqueid}", "SubProducts@downloadAttachment");
Route::get("/show-event/{id}", "SubProducts@showEvent");
});
Route::resource('subproducts', 'SubProducts');
Route::get('/subproduct/{id}', 'FrontendController@singleSubProduct')->name('front.single-subproduct');
//subproducts routes ended



// Trustech careersapply routes
Route::group(['prefix' => 'careersapply'], function () {
    Route::any("/search", "CareersApply@index");
    Route::post("/delete", "CareersApply@destroy")->middleware(['demoModeCheck']);
    Route::get("/show-event/{id}", "CareersApply@showEvent");

    //dynamic load
    Route::any("/{careersapply}/{section}", "CareersApply@showDynamic")->where(['career' => '[0-9]+', 'section' => 'details|comments|files|tasks|invoices|payments|timesheets|expenses|estimates|milestones|tickets|notes|careersapply']);

    Route::delete("/attachments/{uniqueid}", "CareersApply@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "CareersApply@downloadAttachment");
    Route::get("/show-event/{id}", "CareersApply@showEvent");
});
Route::resource('careersapply', 'CareersApply');
//front careersappply routes ended


// routes for dynamic front end products
Route::group(['prefix' => 'fproducts'], function () {
    Route::any("/search", "Fproduct@index");
    Route::post("/delete", "Fproduct@destroy")->middleware(['demoModeCheck']);
    //dynamic load
    Route::any("/{fproducts}/{section}", "Fproduct@showDynamic")->where(['project' => '[0-9]+', 'section' => 'details|comments|files|tasks|invoices|payments|timesheets|expenses|estimates|milestones|tickets|notes|fproducts']);

    Route::delete("/attachments/{uniqueid}", "Fproduct@deleteAttachment");
    Route::get("/attachments/download/{uniqueid}", "Fproduct@downloadAttachment");
});
Route::resource('fproducts', 'Fproduct');
// end of dynamic front end products
//new vusers start
Route::group(['prefix' => 'vusers'], function () {
    Route::any("/search", "VUsers@index");
    Route::get("/updatepreferences", "VUsers@updatePreferences");
    Route::post("/delete", "VUsers@destroy")->middleware(['demoModeCheck']);
        Route::get("/show-event/{id}", "VUsers@showEvent");

});
Route::resource('vusers', 'VUsers');
// new vusers end

// ritems
Route::group(['prefix' => 'ritems'], function () {
    Route::any("/search", "RItem@index");
    Route::post("/delete", "RItem@destroy")->middleware(['demoModeCheck']);
});
Route::resource('ritems', 'RItem');


// end of trustech routes