import ballerina/http;
import ballerina/log;

const string shipNoticeManifestMessageType = "ShipNoticeManifest";
configurable string tokenUrl = "";
configurable string clientId = "";
configurable string clientSecret = "";
configurable string shippingBackEndUrl = "";

service / on new http:Listener(8090) {
    resource function post [string msgTypeId](http:Request req) returns string|error|http:Response|http:Ok|http:InternalServerError {
        string ediMsg = check req.getTextPayload();

        if msgTypeId == shipNoticeManifestMessageType {
            ShipNoticeManifest shipNoticeManifest = check fromEdiString(ediMsg);
            log:printInfo("shipNoticeManifest", shipNoticeManifest = shipNoticeManifest);

            http:Client shippingBackendClient = check new (shippingBackEndUrl,
                auth = {
                    tokenUrl: tokenUrl,
                    clientId: clientId,
                    clientSecret: clientSecret

                }
            );

            http:Response res = check shippingBackendClient->/shippingNotices.post(shipNoticeManifest);
            if res.statusCode == 200 {
                log:printInfo("EDI message converted and passed to the backend successfully");
                return http:OK;
            }
            else {
                return http:INTERNAL_SERVER_ERROR;
            }

        }
        else {
            http:Response response = new;
            response.statusCode = http:STATUS_BAD_REQUEST;
            response.setPayload("Invalid message type");
            return response;
        }

    }

}
