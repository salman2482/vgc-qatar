<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [index] process for the GovtDocuments
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\GovtDocuments;
use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for team members
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {
        
        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //was this call made from an embedded page/ajax or directly on team page
        if (request('source') == 'ext' || request('action') == 'search' || request()->ajax()) {
            
            //template and dom - for additional ajax loading
            switch (request('action')) {

            //typically from the loadmore button
            case 'load':
                $template = 'pages/govtdocument/components/table/ajax';
                $dom_container = '#govtdocuments-td-container';
                $dom_action = 'append';
                break;

            //from the sorting links
            case 'sort':
                $template = 'pages/govtdocument/components/table/ajax';
                $dom_container = '#govtdocuments-td-container';
                $dom_action = 'replace';
                break;

            //from search box or filter panel
            case 'search':
                $template = 'pages/govtdocument/components/table/table';
                $dom_container = '#govtdocuments-table-wrapper';
                $dom_action = 'replace-with';
                break;

            //template and dom - for ajax initial loading
            default:
                $template = 'pages/govtdocument/tabswrapper';
                $dom_container = '#embed-content-container';
                $dom_action = 'replace';
                break;
            }

            //flip sorting url for this particular link - only is we clicked sort menu links
            if (request('action') == 'sort') {
                $sort_url = flipSortingUrl(request()->fullUrl(), request('sortorder'));
                $element_id = '#sort_' . request('orderby');
                $jsondata['dom_attributes'][] = array(
                    'selector' => $element_id,
                    'attr' => 'data-url',
                    'value' => $sort_url);
            }

            //render the view and save to json
            $html = view($template, compact('page', 'govtdocuments'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => $dom_container,
                'action' => $dom_action,
                'value' => $html);

            //move the actions buttons
            if (request('source') == 'ext' && request('action') == '') {
                $jsondata['dom_move_element'][] = array(
                    'element' => '#list-page-actions',
                    'newparent' => '.parent-page-actions',
                    'method' => 'replace',
                    'visibility' => 'show');
                $jsondata['dom_visibility'][] = [
                    'selector' => '#list-page-actions-container',
                    'action' => 'show',
                ];
            }

            //for embedded - change breadcrumb title
            $jsondata['dom_html'][] = [
                'selector' => '.active-bread-crumb',
                'action' => 'replace',
                'value' => strtoupper(__('lang.govtdocuments')),
            ];

            //for embedded request -change active tabs menu
            $jsondata['dom_classes'][] = [
                'selector' => '.tabs-menu-item',
                'action' => 'remove',
                'value' => 'active',
            ];
            $jsondata['dom_classes'][] = [
                'selector' => '#tabs-menu-govtdocuments',
                'action' => 'add',
                'value' => 'active',
            ];

            
            //ajax response
            // dd($jsondata);
            return response()->json($jsondata);

        } else {
            //standard view
            $page['url'] = loadMoreButtonUrl($govtdocuments->currentPage() + 1, request('source'));
            $page['loading_target'] = 'govtdocuments-td-container';
            $page['visibility_show_load_more'] = ($govtdocuments->currentPage() < $govtdocuments->lastPage()) ? true : false;
            return view('pages/govtdocument/wrapper', compact('page', 'govtdocuments'))->render();
        }

    }

}