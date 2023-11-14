
import ballerina/edi;

public isolated function fromEdiString(string ediText) returns ShipNoticeManifest|error {
    edi:EdiSchema ediSchema = check edi:getSchema(schemaJson);
    json dataJson = check edi:fromEdiString(ediText, ediSchema);
    return dataJson.cloneWithType();
}

public isolated function toEdiString(ShipNoticeManifest data) returns string|error {
    edi:EdiSchema ediSchema = check edi:getSchema(schemaJson);
    return edi:toEdiString(data, ediSchema);    
} 

public isolated function getSchema() returns edi:EdiSchema|error {
    return edi:getSchema(schemaJson);
}

public isolated function fromEdiStringWithSchema(string ediText, edi:EdiSchema schema) returns ShipNoticeManifest|error {
    json dataJson = check edi:fromEdiString(ediText, schema);
    return dataJson.cloneWithType();
}

public isolated function toEdiStringWithSchema(ShipNoticeManifest data, edi:EdiSchema ediSchema) returns string|error {
    return edi:toEdiString(data, ediSchema);    
}

public type Header_Type record {|
   string Identifier?;
   string ControlNumber?;
   string Version?;
   string DocumentType?;
|};

public type ShipNotice_Type record {|
   string Identification?;
   string Date?;
   string Time?;
   string TimeZone?;
|};

public type HierarchicalLevel_Type record {|
   string Identification?;
   string HierarchicalID?;
   string HierarchicalParentID?;
   string HierarchicalLevelCode?;
   string HierarchicalChildCode?;
|};

public type ItemIdentification_Type record {|
   string Identification?;
   string ProductID?;
   string ProductDescription?;
   string ProductType?;
   string ProductCode?;
|};

public type ItemDetail_Type record {|
   string Identification?;
   string QuantityShipped?;
   string PackagingInfo?;
   string Weight?;
   string WeightUnit?;
|};

public type ProductDescription_Type record {|
   string Identification?;
   string ItemDescription?;
   string CharacteristicCode?;
   string AdditionalInfo?;
   string InfoQualifier?;
|};

public type Name_Type record {|
   string Identification?;
   string EntityIdentifierCode?;
   string Name?;
   string IdentificationCode?;
   string IdentificationQualifier?;
|};

public type TransactionTotals_Type record {|
   string Identification?;
   string NumberOfLineItems?;
   string HashTotal?;
   string WeightTotal?;
   string WeightUnit?;
|};

public type TransactionSetTrailer_Type record {|
   string Identification?;
   string NumberOfIncludedSegments?;
   string TransactionSetControlNumber?;
|};

public type ShipNoticeManifest record {|
   Header_Type Header;
   ShipNotice_Type ShipNotice;
   HierarchicalLevel_Type HierarchicalLevel;
   ItemIdentification_Type ItemIdentification;
   ItemDetail_Type ItemDetail;
   ProductDescription_Type ProductDescription;
   Name_Type Name;
   TransactionTotals_Type TransactionTotals;
   TransactionSetTrailer_Type TransactionSetTrailer;
|};



final readonly & json schemaJson = {"name":"ShipNoticeManifest", "delimiters":{"segment":"~", "field":"*", "component":":", "repetition":"^"}, "ignoreSegments":[], "segments":[{"code":"ST", "tag":"Header", "minOccurances":1, "fields":[{"tag":"Identifier"}, {"tag":"ControlNumber"}, {"tag":"Version"}, {"tag":"DocumentType"}]}, {"code":"BSN", "tag":"ShipNotice", "minOccurances":1, "fields":[{"tag":"Identification"}, {"tag":"Date"}, {"tag":"Time"}, {"tag":"TimeZone"}]}, {"code":"HL", "tag":"HierarchicalLevel", "minOccurances":1, "fields":[{"tag":"Identification"}, {"tag":"HierarchicalID"}, {"tag":"HierarchicalParentID"}, {"tag":"HierarchicalLevelCode"}, {"tag":"HierarchicalChildCode"}]}, {"code":"LIN", "tag":"ItemIdentification", "minOccurances":1, "fields":[{"tag":"Identification"}, {"tag":"ProductID"}, {"tag":"ProductDescription"}, {"tag":"ProductType"}, {"tag":"ProductCode"}]}, {"code":"SN1", "tag":"ItemDetail", "minOccurances":1, "fields":[{"tag":"Identification"}, {"tag":"QuantityShipped"}, {"tag":"PackagingInfo"}, {"tag":"Weight"}, {"tag":"WeightUnit"}]}, {"code":"PID", "tag":"ProductDescription", "minOccurances":1, "fields":[{"tag":"Identification"}, {"tag":"ItemDescription"}, {"tag":"CharacteristicCode"}, {"tag":"AdditionalInfo"}, {"tag":"InfoQualifier"}]}, {"code":"N1", "tag":"Name", "minOccurances":1, "fields":[{"tag":"Identification"}, {"tag":"EntityIdentifierCode"}, {"tag":"Name"}, {"tag":"IdentificationCode"}, {"tag":"IdentificationQualifier"}]}, {"code":"CTT", "tag":"TransactionTotals", "minOccurances":1, "fields":[{"tag":"Identification"}, {"tag":"NumberOfLineItems"}, {"tag":"HashTotal"}, {"tag":"WeightTotal"}, {"tag":"WeightUnit"}]}, {"code":"SE", "tag":"TransactionSetTrailer", "minOccurances":1, "fields":[{"tag":"Identification"}, {"tag":"NumberOfIncludedSegments"}, {"tag":"TransactionSetControlNumber"}]}]};
    