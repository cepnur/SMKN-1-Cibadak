import gql from "graphql-tag";

export const WELCOMERS = gql`
    query allWelcomers(
        $first: Int!
        $after: String
        $onlyFeatured: Boolean
        $filters: String
        $keywords: String
        $notin: [ID]
    ) {
        welcomers(
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
                databaseId
                link
                title
                excerpt
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
                videoUrl {
                  videoUrl
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
