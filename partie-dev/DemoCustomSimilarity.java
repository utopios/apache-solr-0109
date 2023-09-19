package com.mycompany.solr.similarity;

import org.apache.lucene.search.similarities.BasicStats;
import org.apache.lucene.search.similarities.SimilarityBase;

public class DemoCustomSimilarity extends SimilarityBase {

    @Override
    protected float score(BasicStats stats, float freq, float docLen) {
        // Ici, vous définiriez votre propre algorithme de scoring.
        // Dans cet exemple simplifié, nous utiliserons seulement la fréquence du terme (TF).
        return freq;
    }

    @Override
    public String toString() {
        return "CustomSimilarity";
    }
}
