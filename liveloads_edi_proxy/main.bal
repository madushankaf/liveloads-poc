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

            http:Response res = check shippingBackendClient->/shippingNotices.post(transformExternalShippingNoticeToInternalShippingNotice(shipNoticeManifest));
            if res.statusCode == 200 {
                json payload = check res.getJsonPayload();
                log:printInfo("EDI message converted and passed to the backend successfully", res = payload);
                http:Response response = new;
                response.statusCode = http:STATUS_OK;
                response.setPayload(payload);
                return response;
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

type InternalShippingNotice record {
    string Header_Identifier?;
    string Header_ControlNumber?;
    string Header_Version?;
    string Header_DocumentType?;
    string ShipNotice_Identification?;
    string ShipNotice_Date?;
    string ShipNotice_Time?;
    string ShipNotice_TimeZone?;
    string HierarchicalLevel_Identification?;
    string HierarchicalLevel_HierarchicalID?;
    string HierarchicalLevel_HierarchicalParentID?;
    string HierarchicalLevel_HierarchicalLevelCode?;
    string ItemIdentification_Identification?;
    string ItemIdentification_ProductID?;
    string ItemIdentification_ProductDescription?;
    string ItemIdentification_ProductType?;
    string ItemIdentification_ProductCod?;
    string ItemDetail_Identification?;
    string ItemDetail_QuantityShipped?;
    string ItemDetail_PackagingInfo?;
    string ItemDetail_Weight?;
    string ItemDetail_WeightUnit?;
    string ProductDescription_Identification?;
    string ProductDescription_ItemDescription?;
    string ProductDescription_CharacteristicCode?;
    string ProductDescription_AdditionalInfo?;
    string ProductDescription_InfoQualifier?;
    string Name_Identification?;
    string Name_EntityIdentifierCode?;
    string Name_Name?;
    string Name_IdentificationCode?;
    string Name_IdentificationQualifier?;
    string TransactionTotals_Identification?;
    string TransactionTotals_NumberOfLineItems?;
    string TransactionTotals_HashTotal?;
    string TransactionTotals_WeightTotal?;
    string TransactionSetTrailer_Identification?;
    string TransactionSetTrailer_NumberOfIncludedSegments?;
    string TransactionSetTrailer_TransactionSetControlNumber?;
};

function transformExternalShippingNoticeToInternalShippingNotice(ShipNoticeManifest shipNoticeManifest) returns InternalShippingNotice => {
    Header_Identifier: shipNoticeManifest.Header.Identifier,
    Header_ControlNumber: shipNoticeManifest.Header.ControlNumber,
    Header_Version: shipNoticeManifest.Header.Version,
    Header_DocumentType: shipNoticeManifest.Header.DocumentType,
    ShipNotice_Identification: shipNoticeManifest.ShipNotice.Identification,
    ShipNotice_Date: shipNoticeManifest.ShipNotice.Date,
    ShipNotice_Time: shipNoticeManifest.ShipNotice.Time,
    ShipNotice_TimeZone: shipNoticeManifest.ShipNotice.TimeZone,
    HierarchicalLevel_Identification: shipNoticeManifest.HierarchicalLevel.Identification,
    HierarchicalLevel_HierarchicalID: shipNoticeManifest.HierarchicalLevel.HierarchicalID,
    HierarchicalLevel_HierarchicalParentID: shipNoticeManifest.HierarchicalLevel.HierarchicalParentID,
    HierarchicalLevel_HierarchicalLevelCode: shipNoticeManifest.HierarchicalLevel.HierarchicalLevelCode,
    ItemIdentification_Identification: shipNoticeManifest.ItemIdentification.Identification,

    ItemIdentification_ProductDescription: shipNoticeManifest.ItemIdentification.ProductDescription,
    ItemIdentification_ProductType: shipNoticeManifest.ItemIdentification.ProductType,
    ItemIdentification_ProductCod: shipNoticeManifest.ItemIdentification.ProductCode,
    ItemDetail_Identification: shipNoticeManifest.ItemDetail.Identification,
    ItemDetail_QuantityShipped: shipNoticeManifest.ItemDetail.QuantityShipped,
    ItemDetail_PackagingInfo: shipNoticeManifest.ItemDetail.PackagingInfo,
    ItemDetail_Weight: shipNoticeManifest.ItemDetail.Weight,
    ItemDetail_WeightUnit: shipNoticeManifest.ItemDetail.WeightUnit,
    ProductDescription_Identification: shipNoticeManifest.ProductDescription.Identification,
    ProductDescription_ItemDescription: shipNoticeManifest.ProductDescription.ItemDescription,
    ProductDescription_CharacteristicCode: shipNoticeManifest.ProductDescription.CharacteristicCode,
    ProductDescription_AdditionalInfo: shipNoticeManifest.ProductDescription.AdditionalInfo,
    ProductDescription_InfoQualifier: shipNoticeManifest.ProductDescription.InfoQualifier,
    Name_Identification: shipNoticeManifest.Name.Identification,
    Name_EntityIdentifierCode: shipNoticeManifest.Name.EntityIdentifierCode,
    Name_Name: shipNoticeManifest.Name.Name,
    Name_IdentificationCode: shipNoticeManifest.Name.IdentificationCode,
    Name_IdentificationQualifier: shipNoticeManifest.Name.IdentificationQualifier,
    TransactionTotals_Identification: shipNoticeManifest.TransactionTotals.Identification,
    TransactionTotals_NumberOfLineItems: shipNoticeManifest.TransactionTotals.NumberOfLineItems,
    TransactionTotals_HashTotal: shipNoticeManifest.TransactionTotals.HashTotal,
    TransactionTotals_WeightTotal: shipNoticeManifest.TransactionTotals.WeightTotal,
    TransactionSetTrailer_Identification: shipNoticeManifest.TransactionSetTrailer.Identification,
    TransactionSetTrailer_NumberOfIncludedSegments: shipNoticeManifest.TransactionSetTrailer.NumberOfIncludedSegments,
    TransactionSetTrailer_TransactionSetControlNumber: shipNoticeManifest.TransactionSetTrailer.TransactionSetControlNumber,
    ItemIdentification_ProductID: shipNoticeManifest.ItemIdentification.ProductID

};
