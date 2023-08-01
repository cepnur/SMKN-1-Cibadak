import gql from "graphql-tag";

export const NEWS = gql`
    query allNews(
        $first: Int!
        $after: String
        $onlyFeatured: Boolean
        $filters: String
        $keywords: String
        $notin: [ID]
    ) {
        allNews(
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
                date
                dateOfPublication
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
                customUrl
                newsCategories {
                    nodes {
                        name
                        slug
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
