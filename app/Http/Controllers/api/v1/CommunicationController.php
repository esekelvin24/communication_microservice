<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Storage;

class CommunicationController extends Controller
{

    /**
     *
     * 
     * @OA\Post(
     * path="/send_message_to_subscribers/{chat_id}",
     * summary="Send Message to Subscribers",
     * description="To send Message to users that is subcribed  to a telegram channel",
     * operationId="send_message_to_subscribers",
     * tags={"Send Message to Subscribers"},
     * @OA\Parameter(
     *         name="user-id",
     *         in="header",
     *         description="User ID (E.g. 90000009-9009-9009-9009-900000000009)",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     * @OA\Parameter(
     *          name="chat_id",
     *          description="Chat ID (E.g. -895031573) of the telegram channels users are subscribe to",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     * 
     * @OA\RequestBody(
     *    required=true,
     *    description="Message Details",
     *    @OA\JsonContent(
     *       required={"message"},
     *       @OA\Property(property="message", type="string", format="text", example="There is an announcement about the new coin swapping"),
     *
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Successful Registration",
     *    @OA\JsonContent(
     *       @OA\Property(property="success", type="boolean", example="true"),
     *       @OA\Property(property="message", type="string", example="Success")
     *       
     *       )
     *     )
     * ),
     * 
     * 
     * 
     * 
     * 
     * * @OA\Post(
     * path="/set_recieve_reponse_webhook",
     * summary="Set callback URL Webhook",
     * description="Webhooks to receive responses from messenger API",
     * operationId="set_recieve_reponse_webhook",
     * tags={"Set Webhooks"},
     * @OA\Parameter(
     *         name="user-id",
     *         in="header",
     *         description="User ID (E.g. 90000009-9009-9009-9009-900000000009)",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     * 
     * @OA\RequestBody(
     *    required=true,
     *    description="Message Details",
     *    @OA\JsonContent(
     *       required={"webhook_url"},
     *       @OA\Property(property="webhook_url", type="string", format="text", example="https://domain.com/log_reponse_webhook"),
     *
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Set Webhook Response",
     *    @OA\JsonContent(
     *       @OA\Property(property="success", type="boolean", example="true"),
     *       @OA\Property(property="message", type="string", example="success")
     *       
     *       )
     *     )
     * ),
     * 
     * 
     * 
     * 
     * * @OA\Post(
     * path="/unset_recieve_reponse_webhook",
     * summary="UnSet callback URL Webhook",
     * description="Webhooks to receive responses from messenger API",
     * operationId="unset_recieve_reponse_webhook",
     * tags={"Unset Webhooks"},
     * @OA\Parameter(
     *         name="user-id",
     *         in="header",
     *         description="User ID (E.g. 90000009-9009-9009-9009-900000000009)",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     * 
     * @OA\RequestBody(
     *    required=true,
     *    description="Message Details",
     *    @OA\JsonContent(
     *       required={"webhook_url"},
     *       @OA\Property(property="webhook_url", type="string", format="text", example="https://domain.com/log_reponse_webhook"),
     *
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Set Webhook Response",
     *    @OA\JsonContent(
     *       @OA\Property(property="success", type="boolean", example="true"),
     *       @OA\Property(property="message", type="string", example="success")
     *       
     *       )
     *     )
     * ),
     * 
     */

    public function send_message_to_subscribers($chat_id, Request $request)
    {
        $rules = [
            "message" => "required"
        ];

        $this->validate($request, $rules);

        

        /*$replyMarkup = array(
            'keyboard' => array(
                array("B", "B")
            )
        );
        $encodedMarkup = json_encode($replyMarkup);
        */

        $response = Telegram::sendMessage([
            'chat_id' => $chat_id,
            'text' => $request->message,
            //'reply_markup' =>  $encodedMarkup
        ]);

        return response()->json([
            'success'=>true,
            'message'=>'Message Sent',
            'data'=>$response

        ], 200);
    }

    //use this to set the response webhook
    public function set_recieve_reponse_webhook(Request $request)
    {
        $rules = [
            "webhook_url" => "required"
        ];

        $this->validate($request, $rules);

      

        $endpoint = "https://api.telegram.org/bot6166952906%3AAAGPKyVKlr3ABfqJk5yWtoXvpvIkxuAyk2Q/setWebhook";
        $client = new \GuzzleHttp\Client();
        

        $response = $client->request('GET', $endpoint, ['query' => [
            "url"=> $request->webhook_url."",
            "certificate"=> "Optional"
        ]]);

        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), true);

        
        return response()->json([
            'success'=>true,
            'message'=>'Success',
            'data'=>$content

        ], 200);
       
    }
    

    //use this to log all response from telegram

    public function log_reponse_webhook(Request $request)
    {
        
        $my_log = "webhook_log.txt";

        Storage::put($my_log, $request);
    }

     //use this to remove the response webhook
     public function unset_recieve_reponse_webhook(Request $request)
     {
         $rules = [
             "webhook_url" => "required"
         ];
 
         $this->validate($request, $rules);
 
         $endpoint = "https://api.telegram.org/bot6166952906%3AAAGPKyVKlr3ABfqJk5yWtoXvpvIkxuAyk2Q/setWebhook?remove=";
         $client = new \GuzzleHttp\Client();
         
 
         $response = $client->request('GET', $endpoint, ['query' => [
             "url"=> $request->webhook_url."",
            
         ]]);
 
         $statusCode = $response->getStatusCode();
         $content = json_decode($response->getBody(), true);
 
         
         return response()->json([
             'success'=>true,
             'message'=>'Success',
             'data'=>$content
 
         ], 200);
        
     }




}
