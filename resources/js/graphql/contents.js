import gql from "graphql-tag";

export const CONTENTS = gql`
    query contentNodes(
        $first: Int!
        $after: String
        $onlyFeatured: Boolean
        $filters: String
        $keywords: String
        $contentTypes: [ContentTypeEnum]
        $notin: [ID]
    ) {
        contentNodes(
            first: $first
            after: $after
            where: {
                onlyFeatured: $onlyFeatured
                filters: $filters
                keywords: $keywords
                notIn: $notin
                contentTypes: $contentTypes
            }
        ) {
            pageInfo {
                startCursor
                hasPreviousPage
                hasNextPage
                endCursor
                total
            }
            nodes {
                link
                contentTypeName
                ... on News {
                    dateOfPublication
                    date
                    postImage
                    databaseId
                    link
                    title
                    excerpt
                    featuredImage {
                        node {
                            sourceUrl(size: LARGE)
                        }
                    }
                    newsCategories {
                        nodes {
                            name
                            slug
                        }
                    }
                }
                ... on Resource {
                    date
                    postImage
                    databaseId
                    link
                    title
                    excerpt
                    customUrl
                    featuredImage {
                        node {
                            sourceUrl(size: LARGE)
                            mediaDetails {
                                sizes {
                                    sourceUrl
                                    name
                                }
                            }
                        }
                    }
                    resourcesCategories {
                        nodes {
                            name
                            slug
                        }
                    }
                }
            }
        }
    }
`;
