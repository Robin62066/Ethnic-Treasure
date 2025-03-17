<?php

class User extends Core
{

    function __construct()
    {
        parent::__construct();
    }

    function url_title($str, $lowercase = TRUE)
    {
        $separator = '-';

        $q_separator = preg_quote($separator, '#');

        $trans = array(
            '&.+?;'            => '',
            '[^\w\d _-]'        => '',
            '\s+'            => $separator,
            '(' . $q_separator . ')+'    => $separator
        );

        $str = strip_tags($str);
        foreach ($trans as $key => $val) {
            $str = preg_replace('#' . $key . '#i' . (false ? 'u' : ''), $val, $str);
        }

        if ($lowercase === TRUE) {
            $str = strtolower($str);
        }

        return trim(trim($str, $separator));
    }

    function getProductUrl($id)
    {
        $items = $this->db->select('ai_products', ['id' => $id], 1)->row();
        return "details/$items->slug/" . intval($id);
    }
    function getProductCategory($id)
    {
        $items = $this->db->select('ai_categories', ['id' => $id, 'parent_id' => 0], 1)->row();

        $categoryName = strtolower(str_replace(" ", "-", $items->name));

        return "product-category/$categoryName/" . intval($id);
    }
    function getBlogUrl($id)
    {
        $items = $this->db->select('ai_blog_post', ['id' => $id], 1)->row();
        $slug = strtolower(str_replace(" ", "-", $items->ptitle));
        return "blogs/$slug/" . intval($id);
    }
    function getBlogCategory($id)
    {
        $items = $this->db->select('ai_blog_categories', ['id' => $id], 1)->row();

        $categoryName = strtolower(str_replace(" ", "-", $items->name));

        return "blog-category/$categoryName/" . intval($id);
    }
    function extractKeywordsFromFeatures($text, $numKeywords = 10)
    {
        // Convert text to lowercase for case-insensitive search
        $textLower = strtolower($text);

        // Find the position of the "features" keyword
        $featuresPos = strpos($textLower, 'features');

        // If "features" section is found, extract text from there onwards
        if ($featuresPos !== false) {
            $text = substr($text, $featuresPos + strlen('features:')); // Extract after "Features:"
        } else {
            return "No 'Features' section found.";
        }

        // Remove HTML tags and special characters
        $text = strip_tags($text);
        $text = preg_replace('/[^\w\s]/', '', $text);

        // Split text into words
        $words = explode(" ", trim($text));

        // Expanded stopwords list
        $stopWords = [
            'the',
            'colors',
            'multiple',
            'is',
            'in',
            'and',
            'to',
            'of',
            'for',
            'on',
            'with',
            'this',
            'that',
            'by',
            'from',
            'as',
            'at',
            'it',
            'an',
            'be',
            'or',
            'we',
            'you',
            'our',
            'your',
            'their',
            'its',
            'but',
            'are',
            'a',
            'was',
            'were',
            'has',
            'have',
            'had',
            'not',
            'so',
            'can',
            'if',
            'about',
            'which',
            'who',
            'whom',
            'what',
            'where',
            'when',
            'why',
            'how',
            'all',
            'any',
            'both',
            'each',
            'few',
            'more',
            'most',
            'some',
            'such',
            'no',
            'nor',
            'only',
            'own',
            'same',
            'than',
            'too',
            'very',
            'just',
            'like',
            'also',
            'into',
            'over',
            'under',
            'again',
            'further',
            'then',
            'once',
            'because',
            'while',
            'during',
            'before',
            'after',
            'above',
            'below',
            'between',
            'through',
            'until',
            'without',
            'within',
            'against',
            'down',
            'up',
            'out',
            'off',
            'upon',
            'around',
            'via',
            'even',
            'though',
            'yet',
            'ever',
            'always',
            'never',
            'shall',
            'may',
            'might',
            'must',
            'do',
            'does',
            'did',
            'having',
            'being',
            'been',
            'will',
            'would',
            'should',
            'could',
            'there',
            'here',
            'me',
            'my',
            'mine',
            'he',
            'him',
            'his',
            'she',
            'her',
            'hers',
            'they',
            'them',
            'these',
            'those',
            'us',
            'itself',
            'yourself',
            'ourselves',
            'herself',
            'himself',
            'themselves',
            'each',
            'every',
            'either',
            'neither',
            'much',
            'many',
            'several',
            'throughout',
            'therefore',
            'hence',
            'whereas'
        ];

        // Remove stopwords
        $filteredWords = array_diff($words, $stopWords);

        // Count word frequency
        $wordCounts = array_count_values($filteredWords);

        // Sort by frequency (highest first)
        arsort($wordCounts);

        // Get the top keywords
        $keywords = array_slice(array_keys($wordCounts), 0, $numKeywords);

        // Return as comma-separated string
        return implode(", ", $keywords);
    }
}
