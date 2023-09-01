package com.example.solr;

import org.apache.solr.handler.component.ResponseBuilder;
import org.apache.solr.handler.component.SearchComponent;
import org.apache.solr.common.params.SolrParams;

public class MySearchComponent extends SearchComponent {

    @Override
    public void prepare(ResponseBuilder rb) {
        // Pas besoin de préparation pour ce composant
    }

    @Override
    public void process(ResponseBuilder rb) {
        SolrParams params = rb.req.getParams();
        String query = params.get("q");
        String customValue = "Custom value for query: " + query;
        rb.rsp.add("customField", customValue);
    }

    @Override
    public String getDescription() {
        return "My Custom Search Component";
    }

    @Override
    public String getSource() {
        return "https://github.com/mygithub/my-solr-component";
    }

}
