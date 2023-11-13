import ballerina/http;
import ballerina/log;

const string shipNoticeManifestMessageType = "ShipNoticeManifest";

service / on new http:Listener(8090) {
    resource function post [string msgTypeId](http:Request req) returns string|error|http:Response|http:Ok {
        string ediMsg = check req.getTextPayload();

        if msgTypeId == shipNoticeManifestMessageType {
            ShipNoticeManifest shipNoticeManifest = check fromEdiString(ediMsg);
            log:printInfo("shipNoticeManifest", shipNoticeManifest = shipNoticeManifest);

            return http:OK;

        }
        else {
            http:Response response = new;
            response.statusCode = http:STATUS_BAD_REQUEST;
            response.setPayload("Invalid message type");
            return response;
        }

    }

}
