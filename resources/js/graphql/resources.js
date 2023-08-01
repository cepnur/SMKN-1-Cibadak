import gql from "graphql-tag";

export const RESOURCES = gql`
    query resources(
        $first: Int!
        $after: String
        $onlyFeatured: Boolean
        $filters: String
        $keywords: String
        $notin: [ID]
    ) {
        resources(
            first: $first
            after: $after
            where: {
                onlyFeatured: $onlyFeatured
                filters: $filters
                keywords: $keywords
                notIn: $notin
            }
        ) {
            nodes {
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
                    }
                }
            }
            pageInfo {
                startCursor
                hasPreviousPage
                hasNextPage
                endCursor
                total
            }
        }
    }
`;
