<!--****************************************************************************
 * FoundU - Browse Listings
 * 
 * browseListings.php
 * 
 * This file acts as the view for the Browse Lisitngs page of the FoundU 
 * application. 
 * 
 ****************************************************************************-->
<?php 
    $bodyClass = 'authPage';
    include('../view/header.php'); 
?>

<div class="searchAndFilterDiv">
    <!--Search/Filter Form-->
    <div class="searchForm">
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="search">
            
            <label><i class="fa-solid fa-magnifying-glass"></i></label>
            <input type="text" name="keyword" id="keyword" placeholder="Search Listings"
                   value="<?php echo htmlspecialchars($keyword) ?>">
            
<!--            <input type="submit" value="Search">-->
        </form>
    </div>
        
    <div class="filtersDiv">
        <form action="index.php" method="post">
            <label><i class="fa-solid fa-filter"></i></label>
            <input type="hidden" name="action" value="filter">
            <input type="hidden" name="keyword" 
                   value="<?php echo htmlspecialchars($keyword); ?>">
            
            <div class="filterDropdown">
                <label>Listing Type</label>
                <select name="listingType" id="listingType">
                    <option value="">All</option>
                    <option value="lost" 
                        <?php if($listingType == 'lost') { echo 'selected'; } ?>>
                        Lost
                    </option>
                    <option value="found" 
                        <?php if($listingType == 'found') { echo 'selected'; } ?>>
                        Found
                    </option>
                </select>
                
                <label>Category</label>
                <select name="categoryID" id="categoryID">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo 
                            htmlspecialchars($category->getID()); ?>"
                            <?php if ($categoryID == $category->getID()) { echo 'selected'; } ?>>
                        <?php echo htmlspecialchars($category->getCategoryName()); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <label>University</label>
                <select name="universityID" id="universityID">
                    <option value="">All Universities</option>
                    <?php foreach($universities as $university) : ?>
                        <option value="<?php echo 
                            htmlspecialchars($university->getID()); ?>"
                            <?php if ($universityID == $university->getID()) { echo 'selected'; } ?>>
                        <?php echo htmlspecialchars($university->getShortName()); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <input type="submit" value="Apply">
            </div>   
        </form>
    </div>
</div>

<div class="listings">
    <?php if(empty($listings)) : ?>
        <p id="noListingsFound">No listings found.</p>
    <?php else : ?>
        <div class="listingsGrid">
            <?php foreach($listings as $listing) : ?>
            <a class="listingLink" 
                    href="/FoundUApp/viewListing/index.php?action=viewListing&listingID=<?php echo $listing->getID(); ?>">
            <div class="listingCard">
                <div class="listingTitle">
                    <h2><?php echo htmlspecialchars(ucwords($listing->getItemName())); ?></h2>
                    <p class="listingUniversity">
                        <?php 
                            $university = UniversityDB::getUniversityByID($listing->getUniversityID());
                            echo htmlspecialchars($university->getShortName()); 
                        ?>
                    </p>
                </div>
                <div class="listingImage">
                    <?php if (!empty($listing->getImagePath())): ?>
                        <img src="<?php echo htmlspecialchars($listing->getImagePath()); ?>"
                             alt="<?php echo htmlspecialchars($listing->getItemName()); ?>">
                    <?php else : ?>
                        <img src="/FoundUApp/images/listingImages/listingPlaceholder.png"
                             alt="<?php echo htmlspecialchars($listing->getItemName()); ?>">
                    <?php endif; ?>
                </div>
                
                <div class="listingInfo">
                    <p class="listingType">
                        <?php echo htmlspecialchars(ucfirst($listing->getListingType())); ?>
                    </p>
                    <p class="datePosted">
                        <?php echo htmlspecialchars(DateFormat::timeAgo($listing->getDatePosted())); ?>
                    </p>
                </div>
            </div>
            </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

